<?php

namespace App\Http\Controllers;

use App\Models\ChMessage;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Staff;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
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

    public function getMessagesCount() {
        $totalMessagesCount = 0;
        if (auth()->check() && auth()->user()->userable_type === Staff::class) {
            // Get messages count for admin
            $query = ChMessage::where('to_id', User::getAdmin()->id)
                ->where('seen', 0);
            $totalMessagesCount = $query->count();
        } elseif (auth()->check() && (auth()->user()->userable_type === Client::class || auth()->user()->userable_type === Partner::class)) {
            // Get messages count for client/partner
            $query = ChMessage::where('to_id', auth()->user()->id)
                ->where('seen', 0);
            $totalMessagesCount = $query->count();
        }

        return $totalMessagesCount;
    }
}
