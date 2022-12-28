<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use WeStacks\TeleBot\Laravel\TeleBot;

class TelegramTab extends Component
{
    public function render()
    {
        return view('livewire.settings.telegram-tab');
    }

    public function apiTokenIsSet()
    {
        return TeleBot::bot()->config('token') !== null;
    }

    public function botIsActive()
    {
        try {
            return TeleBot::getMe() !== null;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getBotNameProperty()
    {
        try {
            $name = TeleBot::getMe()->first_name;
        } catch (\Throwable $th) {
            $name = config('telebot.bots.bot.name');
        }

        return $name;
    }

    public function getBotUsernameProperty()
    {
        try {
            $username = TeleBot::getMe()->username;
        } catch (\Throwable $th) {
            $username = '';
        }

        return $username;
    }
}
