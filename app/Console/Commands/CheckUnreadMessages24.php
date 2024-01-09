<?php

namespace App\Console\Commands;

use App\Mail\UnreadMessagesReminder;
use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckUnreadMessages24 extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-unread-messages24';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users who have unread messages for 24 hours';

    /**
     * Execute the console command.
     */
    public function handle() {
        $users = ChMessage::where('seen', 0)
            ->whereBetween('created_at', [now()->subHours(24), now()])
            ->groupBy('to_id')
            ->select('to_id')
            ->latest('created_at')
            ->pluck('to_id');


        $this->sendReminders($users, '');
    }

    private function sendReminders($userIds, $interval) {
        foreach ($userIds as $userId) {
            $user = User::findOrFail($userId);

            Mail::to($user->email)->queue(new UnreadMessagesReminder($interval));
        }
    }
}
