<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller {

    public function store(Request $request) {
        $plan_id = $request->input('plan_id');
        $description = $request->input('description');

        Feature::create([
            'plan_id' => $plan_id,
            'description' => $description
        ]);

        return redirect()->back()->with('status', 'Feature added successfully!');
    }

    public function update(Request $request, Feature $feature) {
        $feature->description = $request->input('description');
        $feature->save();

        return redirect()->back()->with('status', "Feature updated successfully!");
    }

    public function destroy(Feature $feature) {
        $feature->delete();

        return redirect()->back()->with('status', 'Feature deleted successfully!');
    }

    public function fetchFeature($feature_id) {
        $feature = Feature::findOrFail($feature_id);

        return response()->json(['feature' => $feature]);
    }
}
