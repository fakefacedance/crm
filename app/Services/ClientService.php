<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ClientService
{
    public static function deleteTelegramMessages($clientId)
    {
        $telegramCustomField = DB::table('clients_custom_fields')
                    ->where('client_id', $clientId)
                    ->where('name', 'Telegram')
                    ->first();
                    
        if (!isset($telegramCustomField)) return;

        DB::table('telegram_messages')
            ->where('chat_id', $telegramCustomField->value)
            ->delete();
    }
}