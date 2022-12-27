<?php

namespace Database\Seeders;

use App\Models\Deal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealsCustomFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        for ($i = 0; $i < 20; $i++) {         
            DB::table('deals_custom_fields')->insert([
                'name' => fake()->word(),
                'value' => fake()->words(asText:true),
                'deal_id' => Deal::inRandomOrder()->first()->id,
            ]);
        }
    }
}
