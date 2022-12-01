<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Staff::create([
            'full_name' => 'Пупкин Василий Админович',
            'position' => 'gigachad',
            'email' => 'admin@test.com',
            'phone_number' => '89001234567',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now(),            
        ]);

        $admin->assignRole('admin');
    }
}
