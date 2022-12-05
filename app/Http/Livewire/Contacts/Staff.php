<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Staff as ModelsStaff;
use Livewire\Component;

class Staff extends Component
{
    public function render()
    {
        return view('livewire.contacts.staff', [
            'staff' => ModelsStaff::paginate(12)
        ]);
    }
}
