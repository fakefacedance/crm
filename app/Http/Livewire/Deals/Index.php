<?php

namespace App\Http\Livewire\Deals;

use App\Models\Funnel;
use Livewire\Component;

class Index extends Component
{
    public $selectedFunnelId;

    public function mount()
    {
        $this->selectedFunnelId = Funnel::first()->id;
    }

    public function render()
    {        
        return view('livewire.deals.index', [
            'funnels' => Funnel::all()
        ]);
    }

    public function getDealsByStage($stage)
    {
        return $this->selectedFunnel->deals
            ->where('stage', $stage->index)
            ->whereNull('closed_at');
    }

    public function getSelectedFunnelProperty()
    {
        return Funnel::find($this->selectedFunnelId);
    }    

    public function getSuccessfulDealsProperty()
    {
        return $this->selectedFunnel->deals
                ->where('success', true);
    }

    public function getFailedDealsProperty()
    {
        return $this->selectedFunnel->deals
                ->whereNotNull('closed_at')
                ->where('success', false);
    }
}
