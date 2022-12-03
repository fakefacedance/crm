<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Staff;
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

        $testManager = Staff::where('full_name', 'Test Manager')->first();
        Deal::factory(10)->create([
            'staff_id' => $testManager->id
        ]);
    }
}
