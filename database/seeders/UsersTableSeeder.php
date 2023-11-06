<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $usersCount = $this->command->ask('How many users should be added?', 20);
        User::factory()->me()->create();
        User::factory()->count($usersCount)->create();
    }
}
