<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ProjectController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $current_status = $request->query('filter') === 'ongoing' ? '0' : ($request->query('filter') === 'completed' ? '1' : null);
        $projects = Project::with('client.user')->get();
        if ($current_status !== null) {
            $projects = $projects->where('current_status', $current_status);
        }
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
    public function store(StoreProject $request) {
        $validatedData = $request->validated();
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $thumbnail = Image::make($image)
                ->fit(100, 100)
                ->encode($image->getClientOriginalExtension());

            Storage::disk('public')->put('thumbnails/' . $imageName, $thumbnail);
            $thumbnailPath = 'thumbnails/' . $imageName;

            $validatedData['img'] = $thumbnailPath;
        }
        Project::create($validatedData);
        return redirect()->back()->with('status', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $project = Project::with(['client', 'client.user', 'phases', 'phases.tasks'])->findOrFail($id);
        return view('staff.projects.show', [
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
    public function update(UpdateProject $request, string $id) {
        $project = Project::findOrFail($id);
        $validatedData = $request->validated();
        if ($request->hasFile('img')) {
            if (!empty($project->img)) {
                Storage::disk('public')->delete($project->img);
            }

            $image = $request->file('img');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $thumbnail = Image::make($image)
                ->fit(100, 100)
                ->encode($image->getClientOriginalExtension());

            Storage::disk('public')->put('thumbnails/' . $imageName, $thumbnail);
            $thumbnailPath = 'thumbnails/' . $imageName;

            $validatedData['img'] = $thumbnailPath;
        }
        $project->update($validatedData);
        return redirect()->back()->with('status', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $project = Project::findOrFail($id);
        Storage::disk('public')->delete($project->img);
        $project->delete();
        return redirect()->back()->with('status', 'Project deleted successfully!');
    }

    public function fetchProject(string $id) {
        $project = Project::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'project' => $project
        ]);
    }
}
