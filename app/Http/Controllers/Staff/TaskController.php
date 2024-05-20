<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
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

    /**
     * Update all resources in storage.
     */
    public function updateAll(Request $request) {
        $tasksData = $request->input('tasks');
        $phase_id = $request->input('phase_id');

        // Collect all task IDs from the incoming request
        $taskIdsFromRequest = collect($tasksData)->pluck('id')->filter()->all();

        // Fetch existing tasks for the phase
        $existingTasks = Task::where('phase_id', $phase_id)->get();

        // Identify tasks that need to be deleted
        $tasksToDelete = $existingTasks->filter(function ($task) use ($taskIdsFromRequest) {
            return !in_array($task->id, $taskIdsFromRequest);
        });

        // Delete the tasks that are not in the request data
        foreach ($tasksToDelete as $taskToDelete) {
            $taskToDelete->delete();
        }

        // Process the incoming request data
        if (!empty($tasksData)) {
            foreach ($tasksData as $taskData) {
                if ($taskData['id'] == 0) {
                    Task::create([
                        'phase_id' => $phase_id,
                        'task' => $taskData['task'],
                        'status' => $taskData['status']
                    ]);
                } else {
                    $task = Task::findOrFail($taskData['id']);
                    $task->task = $taskData['task'];
                    $task->status = $taskData['status'];
                    $task->save();
                }
            }
        }

        return response()->json(["status" => "success"]);
    }
}
