<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClient;
use App\Models\Client;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $clients = Client::with(['user', 'partner', 'partner.user'])
            ->where('status', Client::QUALIFIED)
            ->where('partner_id', auth()->user()->userable->id)
            ->get();

        return view('partners.clients.index', [
            'clients' => $clients,
            'active_clients' => $clients->where('active', 1)->where('status', Client::QUALIFIED),
            'inactive_clients' => $clients->where('active', 0)->where('status', Client::QUALIFIED),
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
        $client = Client::findOrFail($id);
        $client->user()->delete();
        $client->delete();

        return redirect()->back()->with('status', 'Client deleted successfully!');
    }

    // Update client status
    public function updateClientStatus(Request $request, string $id) {
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
        $client = Client::with(['user', 'partner', 'partner.user'])
            ->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'client' => $client
        ]);
    }
}
