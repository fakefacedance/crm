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
        $createdAt = fake()->dateTimeBetween(startDate:'-1 years', timezone:'Europe/Moscow');
        $closedAt = fake()->optional(0.3)->dateTimeInInterval($createdAt, '+ 2 months', 'Europe/Moscow');

        $clientId = Client::inRandomOrder()->first()->id;
        if ($funnelStage->index === 0) {
            $clientId = fake()->boolean(95) ?: null;
        }

        return [
            'title' => fake()->words(3, true),
            'amount' => fake()->randomFloat(nbMaxDecimals:2, max:99999),
            'stage' => $funnelStage->index,
            'created_at' => $createdAt,
            'closed_at' => $closedAt,
            'success' => !is_null($closedAt) ? fake()->boolean(90) : false,
            'client_id' => $clientId,
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'funnel_id' => Funnel::first()->id
        ];
    }
}
