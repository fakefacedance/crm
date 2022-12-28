<?php

namespace App\Listeners;

use App\Events\TelegramMessageArrived;
use App\Models\Client;
use App\Notifications\MessageNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TelegramMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TelegramMessageArrived  $event
     * @return void
     */
    public function handle(TelegramMessageArrived $event)
    {
        DB::table('telegram_messages')->insert([
            'chat_id' => $event->message->chat->id,
            'correspondent_name' => $event->message->from->first_name . $this->getLastName(),
            'correspondent_type' => 'client',
            'text' => $event->message->text,
            'sent_at' => Carbon::createFromTimestamp($event->message->date, 'Europe/Moscow'),
        ]);
        $this->sendNotification($event->message);
    }

    private function getLastName()
    {
        try {
            $lastName = $this->update->message->from->last_name;
        } catch (\Throwable $th) {
            $lastName = '';
        }

        return $lastName;
    }

    private function sendNotification($message)
    {
        $clientId = DB::table('clients_custom_fields')
                    ->where('name', 'Telegram')
                    ->where('value', $message->chat->id)
                    ->first()
                    ?->client_id;

        if (! isset($clientId)) {
            return;
        }

        $deals = Client::find($clientId)->deals;

        if ($deals->isNotEmpty()) {
            $deals->first()->employee->notify(new MessageNotification($message));
        }
    }
}
