<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CustomFields extends Component
{
    public Client $client;
    public Collection $inputs;    
    public $removed = [];

    protected $rules = [
        'inputs.*.name' => 'required',
        'inputs.*.value' => 'required',        
    ];

    public function render()
    {
        return view('livewire.clients.custom-fields');
    }    

    public function mount(Client $client)
    {                      
        $this->inputs = collect(DB::table('clients_custom_fields')->where('client_id', $client->id)->get());                     
    }

    public function addInput()
    {        
        $this->inputs->push([
            'id' => null,
            'name' => '',
            'value' => '',
            'client_id' => $this->client->id
        ]);
    }

    public function removeInput($key)
    {
        if (isset($this->inputs[$key]['id'])) {
            $this->removed[] = $this->inputs[$key]['id'];
        }

        $this->inputs->pull($key);        
    }

    public function confirm()
    {            
        $this->validate();        

        $this->updateDb();     
        
        return redirect()->route('clients.show', $this->client->id);
    }

    private function updateDb()
    {
        DB::table('clients_custom_fields')->upsert($this->inputs->all(), 'id');

        foreach ($this->removed as $id) {
            DB::table('clients_custom_fields')->delete($id);
        }
        $this->removed = [];
    }
}
