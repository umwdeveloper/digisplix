<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartner;
use App\Http\Requests\UpdatePartner;
use App\Models\Client;
use App\Models\Commission;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Partner;
use App\Models\Project;
use App\Models\User;
use App\Notifications\PartnerCreated;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.partners');

        $partners = Partner::with(['user'])->get();

        return view('staff.partners.index', [
            'partners' => $partners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartner $request) {
        $this->authorize('staff.partners');

        $validatedData = $request->validated();
        $original_password = $validatedData['password'];
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('users');
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('img')) {
                $validatedData['img'] = $image;
            }

            $partner = Partner::create($validatedData);
            $partner->user()->save(
                User::make($validatedData)
            );

            DB::commit();

            Notification::send($partner->user, new PartnerCreated($original_password));

            return redirect()->back()->with('status', 'Partner created successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Delete image
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete($image);
            }

            // Log the exception for debugging
            Log::error(': ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email is already taken.'], 'createPartner')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'createPartner')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $this->authorize('staff.partners');

        $partner = Partner::findOrFail($id);

        $leads = Client::with(['user', 'partner', 'partner.user'])
            ->where('partner_id', $id)
            ->where('is_lead', 1)
            ->get();

        $partners = Partner::with('user')->get();

        $clients = Client::with(['user', 'partner'])
            ->where('partner_id', $partner->id)
            ->where('is_client', 1)
            ->get();

        $projects = Project::with('client')
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->get();

        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $sales = Commission::with(['client', 'client.partner'])
            ->where('type', 0)
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $regionalSales = Commission::join('clients', 'commissions.client_id', '=', 'clients.id')
            ->join('users', function ($join) {
                $join->on('users.userable_id', '=', 'clients.id')
                    ->where('users.userable_type', '=', Client::class);
            })
            ->where('commissions.type', 0)
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->selectRaw('users.country as region, users.country_code AS region_code, COUNT(DISTINCT commissions.id) as sales_count')
            ->groupBy('users.country')
            ->get();

        $commissions = Commission::with(['client', 'client.user', 'client.partner', 'project'])
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->get();

        $totalCommission = Commission::with('client')
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum(DB::raw('deal_size * (commission / 100)')) ?? 0;

        return view('staff.partners.show', [
            'leads' => $leads,
            'partners' => $partners,
            'new_leads_count' => $leads->where('status', Client::NEW_LEAD)->count(),
            'new_leads' => $leads->whereIn('status', [Client::NEW_LEAD, Client::CONTACTED, Client::FOLLOW_UP]),
            'contacted_leads' => $leads->where('status', Client::CONTACTED),
            'follow_up_leads' => $leads->where('status', Client::FOLLOW_UP),
            'in_progress_leads' => $leads->where('status', Client::IN_PROGRESS),
            'failed_leads' => $leads->where('status', Client::FAILED),
            'qualified_leads' => $leads->where('status', Client::QUALIFIED),
            'statuses' => Client::getStatuses(),
            'status_labels' => Client::getStatusLabels(),
            'status_colors' => Client::getStatusColors(),
            'sales' => $sales,
            'revenue' => $commissions->whereBetween('created_at', [$startDate, $endDate])->sum('deal_size'),
            'commission' => $totalCommission,
            'regional_sales' => $regionalSales,
            'currentPartner' => $partner,
            'clients' => $clients,
            'projects' => $projects,
            'commission_statuses' => Commission::getStatuses(),
            'commission_status_labels' => Commission::getStatusLabels(),
            'commission_status_colors' => Commission::getStatusColors(),
            'commissions' => $commissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartner $request, string $id) {
        $this->authorize('staff.partners');

        $partner = Partner::with(['user'])->findOrFail($id);
        $validatedData = $request->validated();

        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('users');
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('img')) {
                if (!empty($partner->user->img)) {
                    Storage::disk('public')->delete($partner->user->img);
                }

                $validatedData['img'] = $image;
            }

            $partner->update($validatedData);
            $partner->user->update($validatedData);

            DB::commit();

            return redirect()->back()->with('status', 'Partner updated successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Delete image
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete($image);
            }

            // Log the exception for debugging
            Log::error('Error updating partner: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email is already taken.'], 'updatePartner')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'updatePartner')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->authorize('staff.partners');

        $partner = Partner::findOrFail($id);
        if (!empty($partner->user->img)) {
            Storage::disk('public')->delete($partner->user->img);
        }
        $partner->user()->delete();
        // $partner->client()->delete();
        $partner->delete();

        return redirect()->back()->with('status', 'Partner deleted successfully!');
    }

    public function fetchPartner(string $id) {
        $this->authorize('staff.partners');

        $partner = Partner::with(['user'])->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'partner' => $partner
        ]);
    }

    public function totalSales(Request $request) {

        $duration = $request->input('duration');
        $partner_id = $request->partner_id;

        $partner = Partner::findOrFail($partner_id);

        $startDate = null;
        $endDate = null;

        // Define date ranges based on the selected duration
        switch ($duration) {
            case 'weekly':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'monthly':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'months_6':
                $startDate = now()->subMonths(6)->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'yearly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'lifetime':
                break;
            default:
                break;
        }

        $sales = Commission::with(['client', 'client.partner'])
            ->where('type', 0)
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return response()->json(['total' => $sales]);
    }

    public function totalRevenue(Request $request) {

        $duration = $request->input('duration');
        $partner_id = $request->partner_id;

        $partner = Partner::findOrFail($partner_id);

        $startDate = null;
        $endDate = null;

        // Define date ranges based on the selected duration
        switch ($duration) {
            case 'weekly':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'monthly':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'months_6':
                $startDate = now()->subMonths(6)->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'yearly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'lifetime':
                break;
            default:
                break;
        }



        $commissions = Commission::with(['client'])
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        return response()->json(['total' => $commissions->sum('deal_size')]);
    }

    public function totalCommission(Request $request) {

        $duration = $request->input('duration');
        $partner_id = $request->partner_id;

        $partner = Partner::findOrFail($partner_id);

        $startDate = null;
        $endDate = null;

        // Define date ranges based on the selected duration
        switch ($duration) {
            case 'weekly':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'monthly':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'months_6':
                $startDate = now()->subMonths(6)->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'yearly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'lifetime':
                break;
            default:
                break;
        }

        $totalCommission = Commission::with('client')
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum(DB::raw('deal_size * (commission / 100)')) ?? 0;

        return response()->json(['total' => $totalCommission]);
    }
}
