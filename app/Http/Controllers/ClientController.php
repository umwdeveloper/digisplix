<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use App\Models\Client;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('clients.projects.index');
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
    public function update(UpdateProfile $request, string $id) {
        $partner = Client::with(['user'])->findOrFail($id);
        $validatedData = $request->validated();

        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('users');
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('img')) {
                if (!empty($partner->user->img)) {
                    Storage::disk('public')->delete($partner->user->img);
                }

                $validatedData['img'] = $image;
            }

            $partner->update($validatedData);
            $partner->user->update($validatedData);

            DB::commit();

            return redirect()->back()->with('status', 'Profile updated successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Delete image
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete($image);
            }

            // Log the exception for debugging
            Log::error('Error updating profile: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email is already taken.'])->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }

    public function profile() {
        $profile = Client::with('user')->findOrFail(Auth::user()->userable->id);
        return view('clients.profile', [
            'profile' => $profile
        ]);
    }

    public function settings() {
        return view('clients.settings');
    }

    public function notifications() {
        $notifications = DB::table('notifications')
            ->select('notifications.*')
            ->join('notification_types', 'notifications.id', '=', 'notification_types.notification_id')
            ->where('notifications.notifiable_id', auth()->user()->id)
            ->where('notification_types.notifiable_type', '!=', Support::class)
            ->orderBy('notifications.created_at', 'DESC')
            ->get();

        $notifications = $notifications->map(function ($notification) {
            $notification->data = json_decode($notification->data, true);
            return $notification;
        });

        // dd($notifications);

        return view('clients.notifications', [
            "notifications" => $notifications
        ]);
    }

    public function resetPassword(Request $request) {
        $validatedData = $request->validate([
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                    $fail("Old password is incorrect!");
                }
            }],
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'password' => Hash::make($validatedData['password'])
        ]);

        Auth::setUser($user);

        return redirect()->back()->with(['status' => "Password has been reset!"]);
    }
}
