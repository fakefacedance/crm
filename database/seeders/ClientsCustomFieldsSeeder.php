<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsCustomFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        for ($i = 0; $i < 20; $i++) {            
            DB::table('clients_custom_fields')->insert([
                'name' => fake()->word(),
                'value' => fake()->words(asText:true),
                'client_id' => Client::inRandomOrder()->first()->id
            ]);
        }
    }
}
