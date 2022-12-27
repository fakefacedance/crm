<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CreateAdminSeeder::class,
            EmployeeSeeder::class,
            ClientsSeeder::class,
            ClientsCustomFieldsSeeder::class,
            DefaultFunnelSeeder::class,
            DealsSeeder::class,
            DealsCustomFieldsSeeder::class,
            TasksSeeder::class,
            TelegramChatSeeder::class,
        ]);
    }
}
