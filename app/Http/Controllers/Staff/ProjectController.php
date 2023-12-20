<?php

namespace App\Http\Controllers\Staff;

use App\Models\ChMessage as Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Notifications\ProjectAdded;
use App\Notifications\ProjectStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ProjectController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $this->authorize('staff.projects');

        $current_status = $request->query('filter') === 'ongoing' ? '0' : ($request->query('filter') === 'completed' ? '1' : null);
        $projects = Project::with('client.user')->get();

        $projects = $projects->map(function ($project) {
            $user = $project->client->user;

            $messagesCount = $this->fetchMessagesCount($user->id);
            $project->setAttribute('messagesCount', $messagesCount);

            return $project;
        });

        $projectsFilter = '';
        if ($current_status !== null) {
            $projectsFilter = $projects->where('current_status', $current_status);
        }
        $clients = Client::with('user')->where('active', 1)->get();

        return view("staff.projects.index", [
            'projects' => $current_status === null ? $projects : $projectsFilter,
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
        $this->authorize('staff.projects');

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
        $project = Project::create($validatedData);

        $project->phases()->createMany([
            ['name' => 'Planning'],
            ['name' => 'Designing'],
            ['name' => 'Development'],
            ['name' => 'Testing'],
        ]);

        Notification::send($project->client->user, new ProjectAdded($project->client->user->name, $project->id, $project->name));

        return redirect()->back()->with('status', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $this->authorize('staff.projects');

        $project = Project::with(['client', 'client.user', 'phases', 'phases.tasks'])->findOrFail($id);

        $messenger_color = Auth::user()->messenger_color;
        return view('staff.projects.show', [
            'project' => $project,
            'id' => $project->client->user->id,
            'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
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
        $this->authorize('staff.projects');

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

        $statusUpdated = $project->current_status != $validatedData['current_status'];

        $project->update($validatedData);

        $status = ["Ongoing", "Completed"];

        if ($statusUpdated) {
            Notification::send($project->client->user, new ProjectStatusUpdated($project->name, $status[$project->current_status], $project->id));
        }

        if ($request->input('_target') == 'ajax') {
            return response()->json(['status' => 'success']);
        } else {
            return redirect()->back()->with('status', 'Project updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->authorize('staff.projects');

        $project = Project::findOrFail($id);
        Storage::disk('public')->delete($project->img);
        $project->delete();
        return redirect()->back()->with('status', 'Project deleted successfully!');
    }

    public function fetchProject(string $id) {
        $this->authorize('staff.projects');

        $project = Project::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'project' => $project
        ]);
    }

    // Fetch messages count for each client
    public function fetchMessagesCount($id) {
        $query = Message::where('from_id', $id)
            ->where('to_id', User::getAdmin()->id)
            ->where('seen', 0);
        $totalMessages = $query->count();

        return $totalMessages;
    }
}
