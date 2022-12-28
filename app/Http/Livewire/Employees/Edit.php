<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use AuthorizesRequests;

    public Employee $employee;

    public $password;
    public $password_confirmation;
    public $roles;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->roles = Role::all('name');

        foreach ($this->roles as $role) {
            $role->checked = $employee->hasRole($role->name);
        }
    }

    public function render()
    {
        return view('livewire.employees.edit');
    }

    public function updateEmployee()
    {
        $this->authorize('edit employee');
        $data = $this->validate();

        if (isset($data['password'])) {
            $this->employee->password = Hash::make($data['password']);
        }

        $this->employee->save();
        $this->employee->syncRoles($this->roles->where('checked', true)->pluck('name')->toArray());

        return redirect()->route('employees.show', $this->employee->id);
    }

    protected function rules()
    {
        return [
            'employee.full_name' => ['required', 'string', 'max:255'],
            'employee.position' => ['required', 'string', 'max:255'],
            'employee.phone_number' => ['required', new PhoneNumber, Rule::unique(Employee::class, 'phone_number')->ignore($this->employee->id)],
            'employee.email' => ['required', 'string', 'email', 'max:255', Rule::unique(Employee::class, 'email')->ignore($this->employee->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'roles.*.name' => ['required', 'exists:' . Role::class . ',name'],
            'roles.*.checked' => ['boolean'],
        ];
    }
}
