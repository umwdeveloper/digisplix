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
        $schedule->command('app:check-unread-messages')->hourly();
        $schedule->command('app:check-unread-messages12')->cron('0 */12 * * *');
        $schedule->command('app:check-unread-messages24')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
