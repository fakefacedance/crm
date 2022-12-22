<?php

namespace App\Services;

use WeStacks\TeleBot\Handlers\UpdateHandler;
use WeStacks\TeleBot\Objects\Update;
use WeStacks\TeleBot\TeleBot;

class MessageUpdateHandler extends UpdateHandler
{
    public function trigger(): bool
    {
        return true;
    }

    public function handle()
    {        
        if ($this->update->message->text === '/start') {
            $this->sendMessage([
                'text' => "Здарова, ".$this->update->message->from->first_name."!\n".
                'Не стесняйся, оставляй заявку. Менеджер свяжется с тобой прямо здесь.'
            ]);
        }

    }
}
