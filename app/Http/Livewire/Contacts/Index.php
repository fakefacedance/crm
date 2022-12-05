<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;

class Index extends Component
{

    public $clientsTabEnabled = false;
    public $staffTabEnabled = false;
    
    public function mount()
    {
        $this->clientsTabEnabled = true;
    }


    public function render()
    {
        return view('livewire.contacts.index');
    }

    public function selectClientsTab()
    {
        $this->clientsTabEnabled = true;
        $this->staffTabEnabled = false;
    }

    public function selectStaffTab()
    {
        $this->clientsTabEnabled = false;
        $this->staffTabEnabled = true;
    }
}
