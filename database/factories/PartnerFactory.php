<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'commission' => fake()->numberBetween(1, 100),
            'facebook' => "www.facebook.com/" . fake()->userName(),
            'linkedin' => "www.linkedin.com/" . fake()->userName(),
            'instagram' => "www.instagram.com/" . fake()->userName(),
        ];
    }
}
