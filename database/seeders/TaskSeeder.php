<?php

namespace Database\Seeders;

use App\Models\Phase;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $phases = Phase::all();

        foreach ($phases as $phase) {
            Task::factory(rand(5, 10))->create([
                'phase_id' => $phase->id,
            ]);
        }
    }
}
