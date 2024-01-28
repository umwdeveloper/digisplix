<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommission;
use App\Http\Requests\UpdateCommission;
use App\Models\Client;
use App\Models\Commission;
use App\Models\Partner;
use App\Models\Project;
use App\Notifications\CommissionCreated;
use App\Notifications\CommissionStatus;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class CommissionController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
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
    public function store(StoreCommission $request) {
        $validatedData = $request->validated();

        $client = Client::findOrFail($validatedData['client_id']);
        $project = Project::findOrFail($validatedData['project_id']);
        $partner = Partner::findOrFail($client->partner_id);

        $commission = Commission::create($validatedData);

        Session::flash('submitted');

        Notification::send($partner->user, new CommissionCreated($validatedData['status'], $project->name, $validatedData['commission'], $validatedData['type'] == 0 ? 'Straight' : 'Recurring', $client->business_name, $commission->id));

        return redirect()->back()->with('status', 'Commission created successfully!');
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
    public function update(UpdateCommission $request, string $id) {
        $validatedData = $request->validated();

        $commission = Commission::with('client', 'client.partner', 'project', 'client.partner.user')->findOrFail($id);

        $statusUpdated = $commission->status !== $validatedData['status'];

        $commission->update($validatedData);

        Session::flash('submitted');

        if ($statusUpdated) {
            Notification::send($commission->client->partner->user, new CommissionStatus($commission->status, $commission->project->name, $commission->commission, $commission->type == 0 ? 'Straight' : 'Recurring', $commission->client->business_name, $commission->id));
        }

        return redirect()->back()->with('status', 'Commission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $commission = Commission::findOrFail($id);

        $notificationTypeIds = $commission->notificationTypes()->pluck('notification_id');

        DB::transaction(function () use ($commission, $notificationTypeIds) {
            $commission->notificationTypes()->delete();

            DatabaseNotification::whereIn('id', $notificationTypeIds)->delete();
        });

        $commission->delete();

        return redirect()->back()->with('status', 'Commission deleted successfully!');
    }

    public function updateCommissionStatus(Request $request, string $id) {
        $commission = Commission::with('client', 'client.partner', 'project', 'client.partner.user')->findOrFail($id);
        $commission->status = $request->status;

        $commission->save();

        Notification::send($commission->client->partner->user, new CommissionStatus($commission->status, $commission->project->name, $commission->commission, $commission->type == 0 ? 'Straight' : 'Recurring', $commission->client->business_name, $commission->id));

        return response()->json(['status' => 'success']);
    }

    public function fetchCommission(string $id) {
        $commission = Commission::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'commission' => $commission
        ]);
    }
}
