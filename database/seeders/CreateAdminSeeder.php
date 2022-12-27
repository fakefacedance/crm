<?php

namespace Database\Seeders;

use App\Models\Employee;
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
        $admin = Employee::create([
            'full_name' => 'Пупкин Василий Админович',
            'position' => 'Администратор',
            'email' => 'admin@test.com',
            'phone_number' => '+7 900 123-45-67',
            'password' => Hash::make('admin'),
            'created_at' => '2012-12-20 12:20:12',            
        ]);

        $admin->assignRole('admin');
    }
}
