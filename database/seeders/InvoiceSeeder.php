<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $invoicesCount = $this->command->ask("How many invoices should be added?", 20);
        $clients = Client::where('active', 1)->where('status', Client::QUALIFIED)->get();
        $categories = Category::all();

        if ($clients->count() > 0) {
            Invoice::factory($invoicesCount)->make()->each(function ($invoice) use ($clients, $categories) {
                $invoice->client_id = $clients->random()->id;
                $invoice->category_id = $categories->random()->id;

                $invoice->save();
            });
        }
    }
}
