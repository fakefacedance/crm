<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRole extends Component
{
    public $roleName;
    public $inputs;
    public $permissions;

    public function mount()
    {
        $this->permissions = Permission::all();

        foreach ($this->permissions as $permission) {
            $this->inputs[$permission->id] = true;
        }
    }

    public function render()
    {
        return view('livewire.settings.create-role');
    }

    public function create()
    {
        $this->createRoleAndAssignPermissions();

        return redirect()->route('settings');
    }

    private function createRoleAndAssignPermissions()
    {
        $role = Role::create(['name' => $this->roleName]);

        foreach ($this->inputs as $permissionId => $checked) {
            if ($checked) {
                $role->givePermissionTo(Permission::findById($permissionId));
            }
        }
    }
}
