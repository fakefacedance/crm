<?php

namespace App\Http\Livewire\IncomingLeads;

use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $leadId;

    protected $listeners = [
        'update-chat' => 'updateLeads',
    ];

    public function mount()
    {
        $this->leadId = $this->leads->first()?->id;
    }

    public function render()
    {
        return view('livewire.incoming-leads.index');
    }

    public function selectLead($leadId)
    {
        $this->leadId = $leadId;
    }

    public function getLeadsProperty()
    {
        $latestMessages = DB::table('telegram_messages')
        ->where('correspondent_type', 'client')
        ->select('chat_id', DB::raw('MAX(sent_at) as dt'))
        ->groupBy('chat_id');

        $latestMessagesGroupedByUser = DB::table('telegram_messages')
                    ->select('telegram_messages.*')
                    ->joinSub($latestMessages, 'latest_messages', function ($join) {
                        $join->on('telegram_messages.chat_id', '=', 'latest_messages.chat_id')
                        ->on('telegram_messages.sent_at', '=', 'latest_messages.dt');
                    })->get();

        $leads = $latestMessagesGroupedByUser->filter(function ($value) {
            return DB::table('clients_custom_fields')
                    ->where('name', 'Telegram')
                    ->where('value', $value->chat_id)->get()
                    ->isEmpty();
        });

        return $leads;
    }

    public function getSelectedLeadProperty()
    {
        return $this->leads
                    ->where('id', $this->leadId)
                    ->first();
    }

    public function updateLeads()
    {
        $this->forgetComputed();
    }

    public function acceptLead()
    {
        $client = Client::create([
            'full_name' => $this->selectedLead->correspondent_name,
            'created_at' => now(),
        ]);

        DB::table('clients_custom_fields')->insert([
            'client_id' => $client->id,
            'field_type_id' => 2,
            'name' => 'Telegram',
            'value' => $this->selectedLead->chat_id,
        ]);

        return redirect()->route('clients.show', $client->id);
    }

    public function declineLead()
    {
        DB::table('telegram_messages')
        ->where('chat_id', $this->selectedLead->chat_id)
        ->delete();

        $this->updateLeads();
        $this->selectLead($this->leads->last()?->id);
    }
}
