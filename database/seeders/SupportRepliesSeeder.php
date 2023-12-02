<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\Support;
use App\Models\SupportReply;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportRepliesSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = User::where('userable_type', Staff::class)->get();
        $tickets = Support::all();

        SupportReply::factory(20)->make()->each(function ($reply) use ($users, $tickets) {
            $ticket = $tickets->random();
            $user_ids = [$users->random()->id, $ticket->user_id];
            $reply->user_id = $user_ids[array_rand($user_ids)];
            $reply->support_id = $ticket->id;

            $reply->save();
        });
    }
}
