<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommission;
use App\Http\Requests\UpdateCommission;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller {
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
    public function store(StoreCommission $request) {
        $validatedData = $request->validated();

        Commission::create($validatedData);

        return redirect()->back()->with('status', 'Commission created successfully!');
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
    public function update(UpdateCommission $request, string $id) {
        $validatedData = $request->validated();

        $commission = Commission::findOrFail($id);
        $commission->update($validatedData);

        return redirect()->back()->with('status', 'Commission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Commission::destroy($id);

        return redirect()->back()->with('status', 'Commission deleted successfully!');
    }

    public function updateCommissionStatus(Request $request, string $id) {
        $commission = Commission::findOrFail($id);
        $commission->status = $request->status;

        $commission->save();

        return response()->json(['status' => 'success']);
    }

    public function fetchCommission(string $id) {
        $commission = Commission::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'commission' => $commission
        ]);
    }
}
