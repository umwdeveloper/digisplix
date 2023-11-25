<?php

namespace Database\Seeders;

use App\Models\Phase;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $projects = Project::all();

        // Store 4 phases for each project
        foreach ($projects as $project) {
            Phase::factory(4)->create([
                'project_id' => $project->id
            ]);
        }
    }
}
