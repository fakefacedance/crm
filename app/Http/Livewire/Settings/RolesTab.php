<?php

namespace App\Http\Livewire\Settings;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesTab extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['roles-tab-selected' => 'tabSelected'];

    public function render()
    {
        return view('livewire.settings.roles-tab', [
            'roles' => Role::paginate(12)
        ]);
    }
    
    public function tabSelected()
    {                        
        $this->resetPage();
    }

    public function deleteRole(Role $role)
    {      
        $this->authorize('delete role');
        
        $role->delete();
    }
}
