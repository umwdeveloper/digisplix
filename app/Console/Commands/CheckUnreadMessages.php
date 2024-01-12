<?php

namespace App\Console\Commands;

use App\Mail\UnreadMessagesReminder;
use App\Models\ChMessage;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
            ->where('created_at', '>', now()->subDay()->subMinute())
            ->groupBy('to_id')
            ->select('to_id', 'created_at')
            ->oldest('created_at')
            ->get();

        $targetTime1 = now()->subHour()->startOfMinute();

        $users1Hour = $users->filter(function ($user) use ($targetTime1) {
            return $user->created_at->format('Y-m-d H:i') === $targetTime1->format('Y-m-d H:i');
        });

        $targetTime12 = now()->subHours(12)->startOfMinute();
        $users12Hours = $users->filter(function ($user) use ($targetTime12) {
            return $user->created_at->format('Y-m-d H:i') === $targetTime12->format('Y-m-d H:i');
        });

        $targetTime24 = now()->subHours(24)->startOfMinute();
        $users24Hours = $users->filter(function ($user) use ($targetTime24) {
            return $user->created_at->format('Y-m-d H:i') === $targetTime24->format('Y-m-d H:i');
        });

        $this->sendReminders($users1Hour, '');
        $this->sendReminders($users12Hours, '');
        $this->sendReminders($users24Hours, '');
    }

    private function sendReminders($users, $interval) {
        foreach ($users as $user) {
            $user = User::findOrFail($user->to_id);

            Mail::to($user->email)->queue(new UnreadMessagesReminder($interval));
        }
    }
}
