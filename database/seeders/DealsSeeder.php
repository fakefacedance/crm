<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deal::factory()->count(10)->create();

        $testManager = Employee::where('full_name', 'Test Manager')->first();
        Deal::factory()->count(5)->create([
            'created_at' => now()->subWeek(),
            'employee_id' => $testManager->id
        ]);
        Deal::factory()->count(5)->create([
            'created_at' => now()->subMonth(),
            'employee_id' => $testManager->id
        ]);
    }
}
