<?php

namespace App\Http\Livewire\Analytics;

use Livewire\Component;

class Index extends Component
{
    public $funnelsTabSelected = true;
    public $managersTabSelected = false;

    public $dateFrom;
    public $dateTo;

    public function mount()
    {
        $this->dateFrom = now()->subMonth()->toDateString();
        $this->dateTo = now()->toDateString();
    }

    public function render()
    {
        return view('livewire.analytics.index');
    }

    public function funnelsTabSelected()
    {
        $this->funnelsTabSelected = true;
        $this->managersTabSelected = false;
    }

    public function managersTabSelected()
    {
        $this->funnelsTabSelected = false;
        $this->managersTabSelected = true;
    }

    // public function dateFromChanged()
    // {                
    //     #
    // }

    // public function dateToChanged()
    // {
    //     #
    // }
}
