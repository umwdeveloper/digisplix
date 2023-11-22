<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $projects = Project::with('client.user')->get();
        $clients = Client::with('user')->where('active', 1)->get();

        return view("staff.projects.index", [
            'projects' => $projects,
            'clients' => $clients,
            'completed_projects' => $projects->where('current_status', 1)->count(),
            'ongoing_projects' => $projects->where('current_status', 0)->count(),
            'paid_projects' => $projects->where('billing_status', 1)->count(),
            'overdue_projects' => $projects->where('billing_status', 0)->count(),
            'status_labels' => Project::getStatusLabels(),
            'billing_labels' => Project::getBillingLabels(),
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
