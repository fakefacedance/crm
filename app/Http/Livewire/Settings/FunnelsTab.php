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
    
    public function render()
    {        
        return view('livewire.settings.funnels-tab', [
            'funnels' => Funnel::orderBy('name')->paginate(12, ['*'], 'funnels_page')
        ]);
    }

    public function deleteFunnel(Funnel $funnel)
    {        
        $this->authorize('delete funnel');

        $funnel->delete();
    }
}
