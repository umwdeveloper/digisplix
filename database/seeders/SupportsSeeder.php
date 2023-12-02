<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportsSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $ticketsCount = $this->command->ask('How many tickets should be added?', 20);

        $users = User::where('userable_type', '!=', Staff::class)->get();

        Support::factory($ticketsCount)->make()->each(function ($ticket) use ($users) {
            $ticket->user_id = $users->random()->id;
            $ticket->save();
        });
    }
}
