<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Index extends Component
{
    public $funnelsTabSelected = true;
    public $rolesTabSelected = false;
    public $telegramTabSelected = false;

    public function render()
    {
        return view('livewire.settings.index');
    }

    public function funnelsTabOnClick()
    {        
        $this->funnelsTabSelected = true;
        $this->rolesTabSelected = false;
        $this->telegramTabSelected = false;
    }

    public function rolesTabOnClick()
    {
        $this->funnelsTabSelected = false;
        $this->rolesTabSelected = true;
        $this->telegramTabSelected = false;
    }

    public function telegramTabOnClick()
    {
        $this->funnelsTabSelected = false;
        $this->rolesTabSelected = false;
        $this->telegramTabSelected = true;
    }
}
