<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::factory(5)->create();

        Staff::factory()->create([
            'full_name' => 'Test Manager',
            'email' => 'test@test.com'
        ]);
    }
}
