<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $current_status = $request->query('filter') === 'ongoing' ? '0' : ($request->query('filter') === 'completed' ? '1' : null);
        $projects = Project::with(['client', 'client.user'])
            ->where('client_id', Auth()->user()->userable->id)
            ->get();
        $projectsFilter = '';
        if ($current_status !== null) {
            $projectsFilter = $projects->where('current_status', $current_status);
        }

        // Get notifications
        $notifications = Auth::user()->unreadNotifications;

        return view("clients.projects.index", [
            'projects' => $current_status === null ? $projects : $projectsFilter,
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

        $project = Project::with(['client', 'client.user', 'phases', 'phases.tasks'])->findOrFail($id);

        $this->authorize('client.projects', $project);

        return view('clients.projects.show', [
            'project' => $project
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
