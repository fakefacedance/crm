<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {        
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->optional(weight:0.6)->email(),
            'phone_number' => fake()->unique()->optional(weight:0.9)->phoneNumber(),
            'created_at' => fake()->dateTimeBetween(startDate:'-1 years', timezone:'Europe/Moscow'),
        ];
    }
}
