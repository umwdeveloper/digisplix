<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => fake()->country(),
            'designation' => fake()->jobTitle(),
            'img' => 'https://i.pravatar.cc/300',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function staff(): static {
        return $this->state(fn (array $attributes) => [
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => fake()->country(),
            'designation' => fake()->jobTitle(),
            'img' => 'https://i.pravatar.cc/300',
        ]);
    }

    public function partner(): static {
        return $this->state(fn (array $attributes) => [
            'name' => 'Partner',
            'email' => 'partner@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => fake()->country(),
            'designation' => fake()->jobTitle(),
            'img' => 'https://i.pravatar.cc/300',
        ]);
    }

    public function client(): static {
        return $this->state(fn (array $attributes) => [
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => fake()->country(),
            'designation' => fake()->jobTitle(),
            'img' => 'users/avatar.png',
        ]);
    }
}
