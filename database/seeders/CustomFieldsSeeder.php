<?php

namespace Database\Seeders;

use App\Enums\CustomField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('custom_fields_types')->insert([
            ['name' => CustomField::STRING, 'value' => 'Строка'],
            ['name' => CustomField::NUMBER, 'value' => 'Число'],
            ['name' => CustomField::DATE, 'value' => 'Дата'],
            ['name' => CustomField::DATETIME, 'value' => 'Дата и время'],
        ]);
    }
}
