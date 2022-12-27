<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TelegramChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        for ($i = 0; $i < 15; $i++) { 
            $chatId = fake()->randomNumber(nbDigits:9, strict:true);
            $client = $this->pickClient();

            if (is_null($client)) {
                $sentAt = fake()->dateTimeInInterval('-1 months', '+5 minutes', 'Europe/Moscow');
            } else {
                $sentAt = fake()->dateTimeInInterval(Carbon::create($client->deals->first()->created_at), '+ 5 minutes', 'Europe/Moscow');
                $this->insertTelegramClientCustomField($client, $chatId);
            }

            $correspondentsNames = [fake()->firstName(), fake()->firstName()];
            $correspondentsTypes = ['client', 'manager'];
            $messagesCount = fake()->numberBetween(1, 10);

            for ($j = 0; $j < $messagesCount; $j++) { 
                $index = fake()->numberBetween(0, 1);                                
                DB::table('telegram_messages')->insert([
                    'chat_id' => $chatId,
                    'correspondent_name' => $correspondentsNames[$index],
                    'correspondent_type' => $correspondentsTypes[$index],
                    'text' => fake()->sentence(),
                    'sent_at' => $sentAt
                ]);
                $sentAt = fake()->dateTimeInInterval($sentAt, '+5 minutes', 'Europe/Moscow');
            }            
        }
    }

    private function pickClient()
    {
        $clientsWithChat = DB::table('clients_custom_fields')
                            ->where('name', 'Telegram')
                            ->get('client_id')
                            ->pluck('client_id');

        return Client::has('deals')
                    ->inRandomOrder()
                    ->get()
                    ->whereNotIn('id', $clientsWithChat)
                    ->first();
    }

    private function insertTelegramClientCustomField($client, $chatId)
    {
        DB::table('clients_custom_fields')->insert([
            'client_id' => $client->id,
            'name' => 'Telegram',
            'value' => $chatId,
        ]);
    }
}
