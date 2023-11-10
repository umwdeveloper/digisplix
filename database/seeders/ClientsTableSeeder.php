<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class ClientsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $clientsCount = $this->command->ask('How many clients should be added?', 20);
        $partners = Partner::all();

        $clients = Client::factory()->count($clientsCount)->make()->each(function ($client) use ($partners) {
            $client->partner_id = $partners->random()->id;
            $client->save();
        });

        // $clients = Client::all();

        $clients->each(function ($client, $index) {
            if ($index === 0) {
                User::factory()->client()->create([
                    'userable_id' => $client->id,
                    'userable_type' => Client::class
                ]);
            } else {
                User::factory()->create([
                    'userable_id' => $client->id,
                    'userable_type' => Client::class
                ]);
            }
        });

        Cache::forget('clients');
    }
}
