<?php

namespace App\Http\Livewire\Deals;

use App\Models\Deal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomFields extends Component
{
    public Deal $deal;
    public Collection $inputs;    
    public $removed = [];

    protected $rules = [
        'inputs.*.name' => 'required',
        'inputs.*.value' => 'required',
        'inputs.*.field_type_id' => 'required',
    ];

    public function render()
    {
        return view('livewire.deals.custom-fields', [
            'customFieldsTypes' => DB::table('custom_fields_types')->get(),
        ]);
    }    

    public function mount(Deal $deal)
    {                      
        $this->deal = $deal;
        $this->inputs = collect(DB::table('deals_custom_fields')->where('deal_id', $deal->id)->get());
    }

    public function addInput()
    {        
        $this->inputs->push([
            'id' => null,
            'name' => '',
            'value' => '',
            'field_type_id' => '',
            'deal_id' => $this->deal->id
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
        
        return redirect()->route('deals.show', $this->deal->id);        
    }

    private function updateDb()
    {
        DB::table('deals_custom_fields')->upsert($this->inputs->all(), 'id');

        foreach ($this->removed as $id) {
            DB::table('deals_custom_fields')->delete($id);
        }
        $this->removed = [];
    }    
}
