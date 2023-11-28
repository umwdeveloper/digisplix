<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StaffController extends Controller {

    public function __construct() {
        $this->middleware("auth");
        $this->authorizeResource(Staff::class, 'staff');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.index');

        $clients = Client::with('projects')->get();

        return view('staff.index', [
            'totalClients' => count($clients),
            'activeClients' => $clients->where('status', 1)->count(),
            'totalProjects' => $clients->pluck('projects')->flatten()->count(),
            'overdueProjects' => $clients->pluck('projects')->flatten()->where('billing_status', 0)->count(),
            'onGoingProjects' => $clients->pluck('projects')->flatten()->where('current_status', 0)->count(),
            'completedProjects' => $clients->pluck('projects')->flatten()->where('current_status', 1)->count(),
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
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
