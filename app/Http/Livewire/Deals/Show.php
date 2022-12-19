<?php

namespace App\Http\Livewire\Deals;

use App\Models\Deal;
use App\Models\Funnel;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public Deal $deal;   
    public Deal $tempDeal; 
    public $selectedTab;
    public $editModeEnabled = false;
    public $funnelStages;
    public $employeeId;

    public $successStageIndex = 254;
    public $failStageIndex = 255;

    protected $rules = [
        'tempDeal.funnel_id' => ['required', 'numeric', 'exists:'.Funnel::class.',id'],
        'tempDeal.title' => ['required', 'max:255'],
        'tempDeal.stage' => ['required', 'numeric'],
        'tempDeal.amount' => ['required', 'min:0', 'max:99999999.99'],
    ];
    protected $listeners = [
        'funnelSelected',
        'tabSelected',
        'editModeToggle',        
        'refreshPage' => '$refresh'
    ];
    
    public function mount(Deal $deal)
    {
        $this->selectedTab = 'tasks';
        $this->funnelStages = $this->deal->funnel->stages;
        $this->employeeId = $this->deal->staff->id;        
        $this->deal = $deal;
        
        if (isset($this->deal->closed_at)) {
            $this->deal->stage = $this->deal->success ? $this->successStageIndex : $this->failStageIndex;
        } 
        $this->tempDeal = $this->deal;        
    }

    public function render()
    {
        $customFields = DB::table('deals_custom_fields')->where('deal_id', $this->deal->id)->get();

        return view('livewire.deals.show', [
            'funnels' => Funnel::all(),
            'customFields' => $customFields,
            'employees' => Staff::all(),
        ]);
    }

    public function funnelSelected()
    {                
        $this->funnelStages = Funnel::find($this->tempDeal->funnel_id)->stages;
        $this->emit('refreshPage');     
    }

    public function tabSelected($tabName)
    {        
        $this->selectedTab = $tabName;
        $this->emit('refreshPage');
    }

    public function editModeToggle()
    {                
        $this->editModeEnabled = !$this->editModeEnabled;
        $this->tempDeal = $this->deal;

        $this->emit('refreshPage');        
    }

    public function saveChanges()
    {                
        $this->validate();

        if ($this->tempDeal->stage == $this->successStageIndex || $this->tempDeal->stage == $this->failStageIndex) {
            $this->tempDeal->closed_at = now();

            if ($this->tempDeal->stage == $this->successStageIndex) {
                $this->tempDeal->success = true;
            } else {
                $this->tempDeal->success = false;
            }
        }

        $this->tempDeal->staff_id = $this->employeeId;
        $this->tempDeal->stage = $this->deal->stage;
        $this->deal = $this->tempDeal;
        $this->deal->save();
        
        $this->editModeEnabled = !$this->editModeEnabled;
    }
}
