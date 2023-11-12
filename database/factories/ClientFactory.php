<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title' => fake()->title(),
            'url' => fake()->url(),
            'business_name' => fake()->name(),
            'business_email' => fake()->unique()->safeEmail(),
            'business_phone' => fake()->phoneNumber(),
            'status' => Client::getStatuses()[array_rand(Client::getStatuses())],
            'joined_at' => now(),
            'followup_date' => now()
        ];
    }
}
