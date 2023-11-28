<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use League\ISO3166\ISO3166;

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
        $iso3166 = new ISO3166();
        $countries = $iso3166->all();
        $country = $countries[array_rand($countries)]['name'];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => $country,
            'country_code' => strtolower($iso3166->name($country)['alpha2']),
            'designation' => fake()->jobTitle(),
            'img' => 'users/avatar.png',
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
        $iso3166 = new ISO3166();
        $countries = $iso3166->all();
        $country = $countries[array_rand($countries)]['name'];

        return $this->state(fn (array $attributes) => [
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => $country,
            'country_code' => strtolower($iso3166->name($country)['alpha2']),
            'designation' => fake()->jobTitle(),
            'img' => 'users/avatar.png',
            'is_admin' => true,
        ]);
    }

    public function partner(): static {
        $iso3166 = new ISO3166();
        $countries = $iso3166->all();
        $country = $countries[array_rand($countries)]['name'];

        return $this->state(fn (array $attributes) => [
            'name' => 'Partner',
            'email' => 'partner@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => $country,
            'country_code' => strtolower($iso3166->name($country)['alpha2']),
            'designation' => fake()->jobTitle(),
            'img' => 'users/avatar.png',
        ]);
    }

    public function client(): static {
        $iso3166 = new ISO3166();
        $countries = $iso3166->all();
        $country = $countries[array_rand($countries)]['name'];

        return $this->state(fn (array $attributes) => [
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'country' => $country,
            'country_code' => strtolower($iso3166->name($country)['alpha2']),
            'designation' => fake()->jobTitle(),
            'img' => 'users/avatar.png',
        ]);
    }
}
