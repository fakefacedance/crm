<?php

namespace App\Http\Livewire\Settings;

use App\Models\Funnel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class FunnelsTab extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['funnels-tab-selected' => 'tabSelected'];    
    
    public function render()
    {        
        return view('livewire.settings.funnels-tab', [
            'funnels' => Funnel::paginate(12)
        ]);
    }

    public function tabSelected()
    {                        
        $this->resetPage();
    }

    public function deleteFunnel(Funnel $funnel)
    {        
        $this->authorize('delete funnel');

        $funnel->delete();
    }
}
