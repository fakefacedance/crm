<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Deal;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $taskRelatesToDeal = fake()->boolean(70);
        $taskRelatesToClient = fake()->boolean(80);
        $deal = $taskRelatesToDeal ? Deal::inRandomOrder()->first() : null;
        $assignerId = Staff::permission('assign to task')->first()->id;
        
        if (is_null($deal)) {
            $createdAt = fake()->dateTimeBetween('-5 years', timezone:'Europe/Moscow');
            $clientId = $taskRelatesToClient ? Client::inRandomOrder()->first()->id : null;
        } else {            
            $createdAt = fake()->dateTimeInInterval($deal->created_at, interval:'+ 6 months', timezone:'Europe/Moscow');
            $clientId = $deal->client_id;
        }

        return [
            'title' => fake()->word(), 
            'priority' => fake()->numberBetween(0, 2),
            'assigner_id' => $assignerId,
            'executor_id' => Staff::where('id', '<>', $assignerId)->inRandomOrder()->first()->id,
            'deal_id' => $deal ? $deal->id : null,
            'client_id' => $clientId,
            'created_at' => $createdAt,
            'deadline' => fake()->dateTimeInInterval($createdAt, interval:'+ 1 month', timezone:'Europe/Moscow'),
            'is_completed' => fake()->boolean(),
        ];
    }
}
