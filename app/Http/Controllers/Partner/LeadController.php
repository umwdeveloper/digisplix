<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLead;
use App\Http\Requests\UpdateLead;
use App\Mail\LeadAddedMail;
use App\Models\Client;
use App\Models\Partner;
use App\Models\User;
use App\Notifications\LeadCreated;
use App\Notifications\LeadStatusUpdated;
use App\Notifications\ProgressLead;
use App\Notifications\QualifiedLead;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class LeadController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        // $leads = Client::with(['user', 'partner', 'partner.user'])
        //     ->where('active', 0)
        //     ->where('status', '!=', Client::QUALIFIED)
        //     ->where('partner_id', auth()->user()->userable->id)
        //     ->get();

        $leads = Client::with(['user', 'partner', 'partner.user'])
            ->where('partner_id', auth()->user()->userable->id)
            ->where('is_lead', 1)
            ->get();

        return view('partners.leads.index', [
            'leads' => $leads,
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
    public function store(StoreLead $request) {
        $validatedData = $request->validated();
        $validatedData['original_password'] = $validatedData['password'];
        $validatedData['password'] = Hash::make($validatedData['password']);

        try {
            DB::beginTransaction();

            $lead = Client::create($validatedData);
            $lead->user()->save(
                User::make($validatedData)
            );

            DB::commit();

            Notification::send(User::getAdmin(), new LeadCreated($lead->partner->user->name));
            // Mail::to($lead->user->email)->send(new LeadAddedMail($lead->user->name, $lead->user->email, $validatedData['original_password']));

            return redirect()->back()->with('status', 'Lead created successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Log the exception for debugging
            Log::error('Error creating lead: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email address is already taken.'], 'createLead')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'createLead')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
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
    public function update(UpdateLead $request, string $id) {
        $lead = Client::findOrFail($id);
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            if (
                $validatedData['status'] == Client::QUALIFIED
                && $validatedData['status'] != $lead->status
                && $lead->is_client == 0
            ) {
                $password = generateRandomPassword();
                $validatedData['password'] = Hash::make($password);

                $validatedData['is_client'] = 1;

                Mail::to($validatedData['email'])->send(new LeadAddedMail($validatedData['name'], $validatedData['email'], $password));
            }

            if ($validatedData['status'] == Client::QUALIFIED && $validatedData['status'] != $lead->status) {
                Notification::send(User::getAdmin(), new QualifiedLead($lead->partner->user->name));
            }

            if ($validatedData['status'] == Client::IN_PROGRESS && $validatedData['status'] != $lead->status) {
                Notification::send(User::getAdmin(), new ProgressLead($lead->partner->user->name));
            }

            $lead->update($validatedData);
            $lead->user->update($validatedData);

            DB::commit();
            return redirect()->back()->with('status', 'Lead updated successfully!');
        } catch (QueryException $e) {
            DB::rollBack();
            // Log the exception for debugging
            Log::error('Error updating lead: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email address is already taken.'], 'updateLead')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'updateLead')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $lead = Client::findOrFail($id);

        if ($lead->is_client == 1) {
            $lead->is_lead = 0;
            $lead->save();
        } else {
            if (!empty($lead->user->img)) {
                Storage::disk('public')->delete($lead->user->img);
            }

            $lead->user()->delete();
            $lead->delete();
        }

        return redirect()->back()->with('status', 'Lead deleted successfully!');
    }

    // Update lead status
    public function updateLeadStatus(Request $request, string $id) {
        try {
            $lead = Client::findOrFail($id);
            $lead->status = $request->status;

            if ($lead->status == Client::QUALIFIED && $lead->is_client == 0) {
                $password = generateRandomPassword();
                $lead->user->password = Hash::make($password);

                $lead->is_client = 1;

                $lead->user->save();

                Mail::to($lead->user->email)->send(new LeadAddedMail($lead->user->name, $lead->user->email, $password));
            }

            if ($lead->status == Client::QUALIFIED) {
                Notification::send(User::getAdmin(), new QualifiedLead($lead->partner->user->name));
            }

            if ($lead->status == Client::IN_PROGRESS) {
                Notification::send(User::getAdmin(), new ProgressLead($lead->partner->user->name));
            }

            $lead->save();

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Fetch lead by ID
    public function fetchLead(string $id) {
        $lead = Client::with(['user', 'partner', 'partner.user'])
            ->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'lead' => $lead
        ]);
    }
}
