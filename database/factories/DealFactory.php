<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Funnel;
use App\Models\FunnelStage;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $funnelStage = Funnel::first()->stages()->inRandomOrder()->first();
        $createdAt = fake()->dateTimeBetween(startDate:'-5 years', timezone:'Europe/Moscow');

        return [
            'title' => fake()->word(),
            'amount' => fake()->randomFloat(nbMaxDecimals:2, max:999999),
            'stage' => $funnelStage->index,
            'created_at' => $createdAt,
            'closed_at' => $funnelStage->index < 4 ? null : fake()->dateTimeInInterval($createdAt, '+ 6 months', 'Europe/Moscow'),
            'client_id' => Client::inRandomOrder()->first()->id,
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'funnel_id' => Funnel::first()->id
        ];
    }
}
