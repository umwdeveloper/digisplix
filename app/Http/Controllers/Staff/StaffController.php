<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaff;
use App\Models\Permission;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StaffController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $staff = Staff::with(['user', 'permissions'])
            ->whereHas('user', function ($query) {
                $query->where('id', '!=', auth()->user()->id);
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
        $validatedData = $request->validated();
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
