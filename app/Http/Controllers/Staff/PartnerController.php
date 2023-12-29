<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartner;
use App\Http\Requests\UpdatePartner;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Partner;
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
            ->get();

        $partners = Partner::with('user')->get();

        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $invoices = Invoice::with(['category', 'client', 'items', 'client.partner', 'client.user'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->where('status', Invoice::PAID)
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->get();

        $regionalSales = Invoice::join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('users', function ($join) {
                $join->on('users.userable_id', '=', 'clients.id')
                    ->where('users.userable_type', '=', Client::class);
            })
            ->where('invoices.status', Invoice::PAID)
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->selectRaw('users.country as region, users.country_code AS region_code, COUNT(DISTINCT invoices.id) as sales_count')
            ->groupBy('users.country')
            ->get();

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
            'invoices' => $invoices,
            'sales' => $invoices->whereBetween('created_at', [$startDate, $endDate])->count(),
            'revenue' => $invoices->whereBetween('created_at', [$startDate, $endDate])->sum('items_sum_price'),
            'commission' => $invoices->whereBetween('created_at', [$startDate, $endDate])->sum('items_sum_price') * ($partner->commission / 100),
            'regional_sales' => $regionalSales,
            'currentPartner' => $partner
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
        $filter = $request->input('filter');
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

        $invoices = Invoice::with(['client'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->where('status', Invoice::PAID)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->whereHas('client', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })
            ->get();

        $sales = $invoices->count();
        $revenue = round($invoices->sum('items_sum_price'));
        $commission = round($invoices->sum('items_sum_price') * ($partner->commission / 100));

        return response()->json(['total' => $filter == 'sales' ? $sales : ($filter == 'revenue' ? $revenue : $commission)]);
    }
}
