<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Client;
use Livewire\Component;

class Clients extends Component
{
    public function render()
    {
        return view('livewire.contacts.clients', [
            'clients' => Client::paginate(12)
        ]);
    }
}
