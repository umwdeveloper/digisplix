<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InvoiceStatusCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:invoice-status-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status to Overdue when due date is expired';

    /**
     * Execute the console command.
     */
    public function handle() {
        Log::info("Status command running");

        $invoices = Invoice::where('due_date', '<', today())
            ->where('status', Invoice::PENDING)
            ->get();

        foreach ($invoices as $invoice) {
            $invoice->update(['status' => Invoice::OVERDUE]);
        }

        Log::info('Status updated!');
    }
}
