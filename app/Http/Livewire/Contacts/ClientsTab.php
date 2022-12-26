<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsTab extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {        
        return view('livewire.contacts.clients-tab', [
            'clients' => Client::orderBy('full_name')->paginate(12, ['*'], 'clients_page')
        ]);
    }
}
