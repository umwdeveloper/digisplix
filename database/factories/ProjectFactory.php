<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => fake()->text(10),
            'description' => fake()->text(),
            'billing_status' => rand(0, 1),
            'current_status' => rand(0, 1),
            'deadline' => Carbon::now()->addDays(fake()->numberBetween(1, 365)),
            'img' => 'thumbnails/project.png',
        ];
    }
}
