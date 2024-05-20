<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller {
    public function index() {
        $plans = Plan::all();

        return view('staff.plans.index', [
            'plans' => $plans
        ]);
    }

    public function features(Plan $plan) {
        $features = $plan->features;
        return view('staff.plans.features', [
            'plan' => $plan,
            'features' => $features
        ]);
    }

    public function fetchPlan($plan_id) {
        $plan = Plan::findOrFail($plan_id);

        return response()->json(['plan' => $plan]);
    }

    public function updateDiscount(Request $request, $plan_id) {
        $plan = Plan::findOrFail($plan_id);

        $plan->discount = $request->input('discount');
        $plan->save();

        return redirect()->back()->with('status', "Discount updated successfully!");
    }
}
