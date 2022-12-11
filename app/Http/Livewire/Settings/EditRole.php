<?php

namespace App\Http\Livewire\Settings;

use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    public Role $role;    
    public $roleName;
    public $permissions;
    public Collection $inputs;

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->roleName = $role->name;
        $this->permissions = Permission::all();
        $this->inputs = collect([]);
        
        foreach ($this->permissions as $permission) {
            $this->inputs->put($permission->id, $this->role->hasPermissionTo($permission));            
        }
    }

    public function render()
    {
        return view('livewire.settings.edit-role');
    }

    public function update()
    {
        $this->updateRoleName();
        $this->updatePermissions();

        return redirect()->route('settings');
    }

    private function updateRoleName()
    {
        $this->role->name = $this->roleName;
        $this->role->save();
    }

    private function updatePermissions()
    {
        $permissionsIds = $this->inputs->filter(function ($value, $key) {
            return $value === true;
        })->keys();

        $newPermissionsSet = Permission::whereIn('id', $permissionsIds)->get();

        $this->role->syncPermissions($newPermissionsSet);        
    }
}
