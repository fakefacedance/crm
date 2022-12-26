<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesTab extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.contacts.employees-tab', [
            'employees' => Staff::orderBy('full_name')->paginate(12, ['*'], 'employees_page')
        ]);
    }
}
