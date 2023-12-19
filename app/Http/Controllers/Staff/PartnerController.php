<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartner;
use App\Http\Requests\UpdatePartner;
use App\Models\Partner;
use App\Models\User;
use App\Notifications\PartnerCreated;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.partners');

        $partners = Partner::with(['user'])->get();

        return view('staff.partners.index', [
            'partners' => $partners
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
    public function store(StorePartner $request) {
        $this->authorize('staff.partners');

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

            $partner = Partner::create($validatedData);
            $partner->user()->save(
                User::make($validatedData)
            );

            DB::commit();

            Notification::send($partner->user, new PartnerCreated($original_password));

            return redirect()->back()->with('status', 'Partner created successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Delete image
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete($image);
            }

            // Log the exception for debugging
            Log::error(': ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email is already taken.'], 'createPartner')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'createPartner')->withInput();
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
    public function update(UpdatePartner $request, string $id) {
        $this->authorize('staff.partners');

        $partner = Partner::with(['user'])->findOrFail($id);
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

            return redirect()->back()->with('status', 'Partner updated successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            // Delete image
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete($image);
            }

            // Log the exception for debugging
            Log::error('Error updating partner: ' . $e->getMessage());

            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['email' => 'The email is already taken.'], 'updatePartner')->withInput();
            }

            return redirect()->back()->withErrors(['db_error' => $e->getMessage()], 'updatePartner')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->authorize('staff.partners');

        $partner = Partner::findOrFail($id);
        if (!empty($partner->user->img)) {
            Storage::disk('public')->delete($partner->user->img);
        }
        $partner->user()->delete();
        $partner->delete();

        return redirect()->back()->with('status', 'Partner deleted successfully!');
    }

    public function fetchPartner(string $id) {
        $this->authorize('staff.partners');

        $partner = Partner::with(['user'])->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'partner' => $partner
        ]);
    }
}
