<?php

namespace Database\Factories;

use App\Models\Support;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'subject' => fake()->text(10),
            'description' => fake()->text(),
            'status' => Support::getStatuses()[array_rand(Support::getStatuses())],
            'priority' => rand(0, 2),
            'department' => rand(0, 2),
        ];
    }
}
