<?php

namespace App\Services\Telegram;

use WeStacks\TeleBot\Handlers\CommandHandler;

class StartCommand extends CommandHandler
{
    protected static $aliases = [ '/start', '/s' ];
    protected static $description = 'Send "/start" or "/s" to get "Hello, World!"';

    public function handle()
    {
        return $this->sendMessage([
            'text' => "Здарова, ".$this->update->message->from->first_name."!\n".
            'Не стесняйся, оставляй заявку. Менеджер свяжется с тобой прямо здесь.'
        ]);
    }
}