<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel {
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:invoice-status-command')->everyFiveMinutes()
            ->appendOutputTo(storage_path('logs/status-overdue.log'));

        // Check unread messages and send reminder to users
        $schedule->command('app:check-unread-messages')->everySecond();

        // $schedule->command('app:process-queue')
        //     ->everySecond()
        //     ->withoutOverlapping()
        //     ->appendOutputTo(storage_path('logs/queue-work.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
