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

    public function render()
    {
        return view('livewire.settings.roles-tab', [
            'roles' => Role::orderBy('name')->paginate(12, ['*'], 'roles_page'),
        ]);
    }

    public function deleteRole(Role $role)
    {
        $this->authorize('delete role');

        $role->delete();
    }
}
