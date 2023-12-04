<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $invoices = Invoice::all();

        $invoices->each(function ($invoice) {
            InvoiceItem::factory(rand(1, 5))->create([
                'invoice_id' => $invoice->id,
            ]);
        });
    }
}
