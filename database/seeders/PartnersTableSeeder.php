<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $partnersCount = $this->command->ask('How many partners should be added?', 20);
        $partners = Partner::factory()->count($partnersCount)->create();

        $partners->each(function ($partner, $index) {
            if ($index === 0) {
                User::factory()->partner()->create([
                    'userable_id' => $partner->id,
                    'userable_type' => Partner::class
                ]);
            } else {
                User::factory()->create([
                    'userable_id' => $partner->id,
                    'userable_type' => Partner::class
                ]);
            }
        });
    }
}
