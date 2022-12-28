<?php

namespace App\Http\Livewire\IncomingLeads;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WeStacks\TeleBot\Laravel\TeleBot;

class Chat extends Component
{
    public $lead;
    public $messageToSend;

    protected $listeners = [
        'update-chat' => 'updateMessages',
    ];

    public function mount($leadId)
    {
        $this->lead = (array) DB::table('telegram_messages')->where('id', $leadId)->first();
    }

    public function render()
    {
        return view('livewire.incoming-leads.chat');
    }

    public function sendMessage()
    {
        $msg = TeleBot::sendMessage([
            'chat_id' => $this->lead['chat_id'],
            'text' => auth()->user()->full_name . "\n\n" . $this->messageToSend,
        ]);

        $message = [
            'chat_id' => $this->lead['chat_id'],
            'correspondent_name' => auth()->user()->full_name,
            'correspondent_type' => 'manager',
            'text' => $this->messageToSend,
            'sent_at' => Carbon::createFromTimestamp($msg->date, 'Europe/Moscow'),
        ];
        DB::table('telegram_messages')->insert($message);

        $this->messageToSend = '';
    }

    public function getMessagesProperty()
    {
        return DB::table('telegram_messages')
                    ->where('chat_id', $this->lead['chat_id'])
                    ->get()
                    ->map(fn ($value) => (array) $value);
    }

    public function updateMessages()
    {
        $this->forgetComputed();
        $this->emit('chat-updated');
    }
}
