<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller {

    public function __construct() {
        $this->middleware("auth");
        // $this->authorizeResource(Staff::class, 'staff');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.index');

        $clients = Client::with('projects')->get();

        $deliveries = Project::with('client.user')->orderBy('deadline')->take(5)->get();

        $regionalSales = Invoice::join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('users', function ($join) {
                $join->on('users.userable_id', '=', 'clients.id')
                    ->where('users.userable_type', '=', Client::class);
            })
            ->where('invoices.status', Invoice::PAID)
            ->selectRaw('users.country as region, users.country_code AS region_code, COUNT(DISTINCT invoices.id) as sales_count')
            ->groupBy('users.country')
            ->get();

        return view('staff.index', [
            'totalClients' => count($clients),
            'activeClients' => $clients->where('status', 1)->count(),
            'totalProjects' => $clients->pluck('projects')->flatten()->count(),
            'overdueProjects' => $clients->pluck('projects')->flatten()->where('billing_status', 0)->count(),
            'onGoingProjects' => $clients->pluck('projects')->flatten()->where('current_status', 0)->count(),
            'completedProjects' => $clients->pluck('projects')->flatten()->where('current_status', 1)->count(),
            'deliveries' => $deliveries,
            'regional_sales' => $regionalSales,
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
    public function update(UpdateProfile $request, string $id) {
        $staff = Staff::with(['user'])->findOrFail($id);
        $validatedData = $request->validated();

        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('users');
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('img')) {
                if (!empty($staff->user->img)) {
                    Storage::disk('public')->delete($staff->user->img);
                }

                $validatedData['img'] = $image;
            }

            $staff->user->update($validatedData);

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
        $profile = Staff::with('user')->findOrFail(Auth::user()->userable->id);
        return view('staff.profile', [
            'profile' => $profile
        ]);
    }

    public function settings() {
        return view('staff.settings');
    }

    public function notifications() {
        return view('staff.notifications');
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
