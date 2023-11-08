<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $staffCount = $this->command->ask('How many staff should be added?', 20);
        $staff = Staff::factory()->count($staffCount)->create();

        $staff->each(function ($st, $index) {
            if ($index === 0) {
                User::factory()->staff()->create([
                    'userable_id' => $st->id,
                    'userable_type' => Staff::class
                ]);
            } else {
                User::factory()->create([
                    'userable_id' => $st->id,
                    'userable_type' => Staff::class
                ]);
            }
        });
    }
}
