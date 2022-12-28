<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;

class Index extends Component
{
    public $clientsTabSelected = true;
    public $managersTabSelected = false;

    public function render()
    {
        return view('livewire.contacts.index');
    }

    public function clientsTabOnClick()
    {
        $this->clientsTabSelected = true;
        $this->managersTabSelected = false;
    }

    public function managersTabOnClick()
    {
        $this->clientsTabSelected = false;
        $this->managersTabSelected = true;
    }
}
