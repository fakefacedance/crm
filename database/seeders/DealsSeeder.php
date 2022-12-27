<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Deal::factory(10)->create();

        $testManager = Employee::where('full_name', 'Test Manager')->first();
        Deal::factory(10)->create([
            'employee_id' => $testManager->id
        ]);
    }
}
