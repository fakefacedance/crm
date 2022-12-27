<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Deal;
use App\Models\Employee;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $deal = fake()->boolean(80) ? Deal::inRandomOrder()->first() : null;
        
        if (is_null($deal)) {
            $createdAt = fake()->dateTimeBetween(startDate:'-1 years', timezone:'Europe/Moscow');
            $clientId = fake()->boolean(80) ? Client::inRandomOrder()->first()->id : null;
        } else {            
            $createdAt = fake()->dateTimeInInterval($deal->created_at, '+2 days', 'Europe/Moscow');
            $clientId = $deal->client_id;
        }
        $assignerId = Employee::permission('assign to task')->inRandomOrder()->first()->id;
        $deadline = fake()->dateTimeInInterval(Carbon::create($createdAt)->addDays(2), '+1 week', 'Europe/Moscow');

        return [
            'title' => fake()->word(),
            'description' => fake()->optional(0.8)->sentence(10),
            'assigner_id' => $assignerId,
            'executor_id' => Employee::inRandomOrder()->first()->id,
            'deadline' => $deadline,
            'remind_at' => fake()->optional(0.2)->dateTimeBetween($createdAt, Carbon::create($deadline)->subDay(), 'Europe/Moscow'),
            'priority' => fake()->numberBetween(0, 2),
            'client_id' => $clientId,
            'deal_id' => $deal?->id,
            'is_completed' => fake()->boolean(),
            'created_at' => $createdAt,
        ];
    }
}
