<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartner;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Image;

class PartnerController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
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
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $userImg = Image::make($image)
                ->fit(100, 100)
                ->encode($image->getClientOriginalExtension());

            Storage::disk('public')->put('users/' . $imageName, $userImg);
            $userImgPath = 'users/' . $imageName;

            $validatedData['img'] = $userImgPath;
        }

        $partner = Partner::create($validatedData);
        $partner->user()->save(
            User::make($validatedData)
        );

        return redirect()->back()->with('status', 'Partner created successfully!');
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
