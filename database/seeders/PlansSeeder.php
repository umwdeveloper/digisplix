<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Plan::insert([
            ['name' => 'silver', 'price_id' => 'price_1ORQCFHymsUfbx7xhGtUSwpP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'gold', 'price_id' => 'price_1ORQDzHymsUfbx7xPnV7Hqev', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'platinum', 'price_id' => 'price_1ORQENHymsUfbx7xUn8WeRgk', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'diamond', 'price_id' => 'price_1ORQEsHymsUfbx7xM9jVU23C', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
