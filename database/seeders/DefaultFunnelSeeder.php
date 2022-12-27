<?php

namespace Database\Seeders;

use App\Models\Funnel;
use App\Models\FunnelStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultFunnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $funnel = Funnel::create([
            'name' => 'Сделки'
        ]);

        $funnelStages = [
            'Лид', 
            'Потребность выявлена', 
            'Договор и счет отправлены',
            'Счет оплачен',
        ];

        foreach ($funnelStages as $key => $value) {
            FunnelStage::create([
                'name' => $value,
                'index' => $key,
                'funnel_id' => $funnel->id,
            ]);
        }        
    }
}
