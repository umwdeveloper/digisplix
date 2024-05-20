<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class ServiceController extends Controller {
    public function index() {
        $plans = Plan::with('features')->get();
        return view('clients.services.index', compact('plans'));
    }
}
