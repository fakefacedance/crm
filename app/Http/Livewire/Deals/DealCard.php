<?php

namespace App\Http\Livewire\Deals;

use App\Models\Deal;
use Livewire\Component;

class DealCard extends Component
{
    public Deal $deal;

    public function mount(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function render()
    {
        return view('livewire.deals.deal-card');
    }

    public function getAmountFormattedProperty()
    {
        return number_format($this->deal->amount, 2, ',', ' ');
    }
}
