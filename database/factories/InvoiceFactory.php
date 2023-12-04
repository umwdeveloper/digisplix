<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'invoice_id' => (string) Str::uuid(),
            'status' => Invoice::getStatuses()[array_rand(Invoice::getStatuses())],
            'sent' => rand(0, 1),
            'due_date' => now()->addDays(rand(5, 50)),
            'terms_n_conditions' => fake()->text(50),
            'note' => fake()->text(50),
            'signature' => fake()->text(10),
        ];
    }
}
