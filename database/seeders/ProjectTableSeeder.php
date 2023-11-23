<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $projectsCount = $this->command->ask('How many projects should be added?', 20);

        $clients = Client::where('active', 1)->get();

        Project::factory()->count($projectsCount)->make()->each(function ($project) use ($clients) {
            $project->client_id = $clients->random()->id;
            $project->save();
        });
    }
}
