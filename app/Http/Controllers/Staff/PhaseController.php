<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use App\Models\Project;
use Illuminate\Http\Request;

class PhaseController extends Controller {
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
    public function store($project_id) {
        $project = Project::findOrFail($project_id);
        $phases_count = count($project->phases);

        if ($phases_count === 10) {
            return redirect()->back()->with("error", "You can create maximum of 10 phases!");
        } else {
            $project->phases()->create([
                'name' => "Phase " . $phases_count + 1
            ]);

            return redirect()->back();
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
    public function update(Request $request, string $id) {
        $phase = Phase::findOrFail($id);
        $phase->name = $request->input('name');
        $phase->status = $request->input('status');
        $phase->progress = $request->input('progress');

        $phase->save();

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Phase::destroy($id);

        return redirect()->back()->with('status', 'Phase deleted successfully!');
    }
}
