<?php

namespace App\Console\Commands;

use App\Mail\UnreadMessagesReminder;
use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckUnreadMessages extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-unread-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users who have unread messages';

    /**
     * Execute the console command.
     */
    public function handle() {
        $users = ChMessage::where('seen', 0)
            ->where(function ($query) {
                $query->where('created_at', '<=', now()->subHour())
                    ->orWhere('created_at', '<=', now()->subHours(12))
                    ->orWhere('created_at', '<=', now()->subHours(24));
            })
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
