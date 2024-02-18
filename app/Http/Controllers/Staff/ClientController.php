<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClient;
use App\Models\Client;
use App\Models\NotificationType;
use App\Models\Partner;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller {

    public function __construct() {
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.clients');

        $clients = Client::with(['user', 'partner', 'partner.user'])
            ->where('is_client', 1)
            ->get();

        $partners = Partner::with('user')->get();

        return view('staff.clients.index', [
            'clients' => $clients,
            'active_clients' => $clients->where('active', 1),
            'inactive_clients' => $clients->where('active', 0),
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
    public function store(Request $request) {
        //
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
    public function update(UpdateClient $request, string $id) {
        $this->authorize('staff.clients');

        $client = Client::findOrFail($id);
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $client->update($validatedData);
            $client->user->update($validatedData);

            DB::commit();

            return redirect()->back()->with('status', 'Client updated successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Log the exception for debugging
            Log::error('Error updating client: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email address is already taken.'], 'updateClient')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'updateClient')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->authorize('staff.clients');

        $client = Client::findOrFail($id);

        if ($client->is_lead == 1) {
            $client->is_client = 0;
            $client->projects()->delete();
            $client->save();
        } else {
            if (!empty($client->user->img)) {
                Storage::disk('public')->delete($client->user->img);
            }

            $notificationTypeIds = $client->notificationTypes()->pluck('notification_id');
            $notificationIds2 = NotificationType::where('notification_to', $client->user->id)
                ->pluck('notification_id');

            DB::transaction(function () use ($client, $notificationTypeIds, $notificationIds2) {
                $client->notificationTypes()->delete();

                NotificationType::whereIn('notification_id', $notificationIds2)->delete();
                DatabaseNotification::whereIn('id', $notificationIds2)->delete();
                DatabaseNotification::whereIn('id', $notificationTypeIds)->delete();
            });

            $client->delete();
        }

        return redirect()->back()->with('status', 'Client deleted successfully!');
    }

    // Update client status
    public function updateClientStatus(Request $request, string $id) {
        $this->authorize('staff.clients');

        try {
            $client = Client::findOrFail($id);
            $client->active = $request->status;
            $client->save();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Fetch client by ID
    public function fetchClient(string $id) {
        $this->authorize('staff.clients');

        $client = Client::with(['user', 'partner', 'partner.user'])
            ->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'client' => $client
        ]);
    }
}
