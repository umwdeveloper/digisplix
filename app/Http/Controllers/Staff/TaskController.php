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
                $task->update();
            }
        }

        return response()->json(["status" => "success"]);
    }
}
