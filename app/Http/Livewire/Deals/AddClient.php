<?php

namespace App\Http\Livewire\Deals;

use App\Models\Client;
use App\Models\Deal;
use Livewire\Component;

class AddClient extends Component
{
    public Deal $deal;
    public $buttonClicked = false;
    public $clientId;

    public function mount(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function render()
    {
        return view('livewire.deals.add-client', [
            'clients' => Client::all(),
        ]);
    }

    public function addClientOnClick()
    {
        $this->buttonClicked = true;
    }

    public function submit()
    {
        $this->deal->client_id = $this->clientId;
        $this->deal->save();

        $this->emitUp('refreshParent');
    }
}
