<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaff;
use App\Http\Requests\UpdateStaff;
use App\Models\Permission;
use App\Models\Staff;
use App\Models\User;
use App\Notifications\StaffCreated;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StaffController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.staff');

        // dd(auth()->user());

        $staff = Staff::with(['user', 'permissions'])
            ->whereHas('user', function ($query) {
                $query->where('id', '!=', auth()->user()->id)
                    ->where('is_admin', 0);
            })->get();

        $permissions = Permission::all();

        return view('staff.staff.index', [
            'staff' => $staff,
            'permissions' => $permissions
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
    public function store(StoreStaff $request) {
        $this->authorize('staff.staff');

        $validatedData = $request->validated();
        $original_password = $validatedData['password'];
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('img')) {
            $image = $request->file('img')->store('users');
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('img')) {
                $validatedData['img'] = $image;
            }

            $staff = new Staff();
            $staff->save();
            $staff->user()->save(
                User::make($validatedData)
            );

            $permissions = $request->input('permissions');
            $staff->permissions()->attach($permissions);

            DB::commit();

            Notification::send($staff->user, new StaffCreated($original_password));

            return redirect()->back()->with('status', 'Staff created successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Delete image
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete($image);
            }

            // Log the exception for debugging
            Log::error('Error creating staff: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email is already taken.'], 'createStaff')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'createStaff')->withInput();
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
    public function update(UpdateStaff $request, string $id) {
        $this->authorize('staff.staff');

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

            $permissions = $request->input('permissions');
            $staff->permissions()->sync($permissions);

            DB::commit();

            return redirect()->back()->with('status', 'Staff updated successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Delete image
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete($image);
            }

            // Log the exception for debugging
            Log::error('Error updating staff: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email is already taken.'], 'updateStaff')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'updateStaff')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->authorize('staff.staff');

        $staff = Staff::findOrFail($id);

        if (!empty($staff->user->img)) {
            Storage::disk('public')->delete($staff->user->img);
        }

        $staff->user()->delete();
        $staff->delete();

        return redirect()->back()->with('status', 'Staff deleted successfully!');
    }

    public function fetchStaff(string $id) {
        $this->authorize('staff.staff');

        $staff = Staff::with(['user', 'permissions:id'])->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'staff' => $staff
        ]);
    }
}
