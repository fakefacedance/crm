<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::factory()->count(20)->create();

        $testManager = Employee::where('full_name', 'Test Manager')->first();
        Task::factory()->count(10)->create([
            'executor_id' => $testManager->id
        ]);
        Task::factory()->count(5)->create([
            'executor_id' => $testManager->id,
            'deadline' => Carbon::create(now()->toDateString())->addHours(23)->addMinutes(59)->addSeconds(59),
            'is_completed' => false,
        ]);
        Task::factory()->count(2)->create([
            'executor_id' => $testManager->id,
            'deadline' => now()->addDay(),
            'is_completed' => false,
        ]);
        Task::factory()->count(3)->create([
            'executor_id' => $testManager->id,
            'deadline' => now()->addDays(3),
            'is_completed' => false,
        ]);
    }
}
