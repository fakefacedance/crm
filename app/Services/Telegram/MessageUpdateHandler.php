<?php

namespace App\Services\Telegram;

use App\Events\TelegramMessageArrived;
use WeStacks\TeleBot\Handlers\UpdateHandler;

class MessageUpdateHandler extends UpdateHandler
{
    public function trigger(): bool
    {
        return isset($this->update->message->text); // handle regular text messages
    }

    public function handle()
    {        
        TelegramMessageArrived::dispatch($this->update->message);
    }
}
