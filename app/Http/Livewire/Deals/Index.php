<?php

namespace App\Http\Livewire\Deals;

use App\Models\Funnel;
use Livewire\Component;

class Index extends Component
{
    public Funnel $selectedFunnel;           

    protected $rules = [
        'selectedFunnel.id' => 'required|numeric',
    ];
    protected $listeners = [
        'funnelSelected',
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->selectedFunnel = Funnel::first();        
    }

    public function render()
    {        
        return view('livewire.deals.index', [
            'funnels' => Funnel::all()
        ]);
    }

    public function funnelSelected()
    {        
        $this->emit('refresh');
    }
}
