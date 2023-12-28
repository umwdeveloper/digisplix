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
        $recurring = rand(0, 1);
        return [
            'invoice_id' => getRandomCode(6),
            'invoice_from' => fake()->name(),
            'invoice_to' => fake()->name(),
            'status' => Invoice::getStatuses()[array_rand(Invoice::getStatuses())],
            'sent' => rand(0, 1),
            'due_date' => now()->addDays(rand(5, 50)),
            'terms_n_conditions' => fake()->text(50),
            'note' => fake()->text(50),
            'recurring' => $recurring,
            'start_from' => $recurring ? now()->addDays(rand(5, 50)) : null,
            'duration' => $recurring ? rand(1, 36) : null,
            // 'account_holder_name' => fake()->name(),
            // 'bank_name' => fake()->text(10),
            // 'ifsc_code' => fake()->swiftBicNumber(),
            // 'account_number' => fake()->creditCardNumber()
        ];
    }
}
