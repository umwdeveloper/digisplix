<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLead;
use App\Http\Requests\UpdateLead;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LeadController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $leads = Client::with(['user', 'partner', 'partner.user'])->where('active', 0)->get();

        return view('staff.leads.index', [
            'leads' => $leads,
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
        $validatedData['password'] = Hash::make($validatedData['password']);
        $lead = Client::create($validatedData);
        $lead->user()->save(
            User::make($validatedData)
        );

        return redirect()->back()->with('status', 'Lead created successfully!');
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
        $lead->update($validatedData);
        $lead->user->update($validatedData);

        return redirect()->back()->with('status', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Client::destroy($id);

        return redirect()->back()->with('status', 'Client deleted successfully!');
    }

    // Update lead status
    public function updateLeadStatus(Request $request, string $id) {
        try {
            $lead = Client::findOrFail($id);
            $lead->status = $request->status;
            $lead->save();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Fetch lead by ID
    public function fetchLead(string $id) {
        $lead = Client::with(['user', 'partner', 'partner.user'])
            ->where('active', 0)
            ->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'lead' => $lead
        ]);
    }
}
