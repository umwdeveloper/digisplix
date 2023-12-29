<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessQueue extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Keep queue worker running';

    /**
     * Execute the console command.
     */
    public function handle() {
        Log::info('Queue command running');

        // Run the queue worker with the --max-time option
        $this->call('queue:work', ['--max-time' => 120]);

        $this->info('Queue processing completed.');
    }
}
