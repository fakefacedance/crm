<?php

namespace App\Http\Livewire\Settings;

use App\Models\Funnel;
use App\Models\FunnelStage;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditFunnel extends Component
{
    public Funnel $funnel;
    public Collection $inputs;
    public $funnelName;
    public $removedStages = [];

    protected function rules()
    {
        return [
            'funnelName' => 'required',
            'inputs.*.name' => 'required',
            'inputs.*.index' => ['required', 'distinct', 'numeric', 'max:'. $this->inputs->count() - 1],
        ];
    }

    public function mount(Funnel $funnel)
    {
        $this->funnel = $funnel;
        $this->funnelName = $funnel->name;
        $this->inputs = collect($funnel->stages)->sortBy('index')->values();                
    }

    public function render()
    {
        return view('livewire.settings.edit-funnel');
    }

    public function addInput()
    {
        $this->inputs->push([
            'id' => null,
            'funnel_id' => $this->funnel->id,
            'name' => '',
            'index' => $this->inputs->count(),
        ]);
    }

    public function removeInput($key)
    {
        if (isset($this->inputs[$key]['id'])) {
            $this->removedStages[] = $this->inputs[$key]['id'];
        }

        $this->inputs->pull($key);
    }

    public function update()
    {               
        $this->validate();        

        $this->updateFunnelModel();
        $this->updateFunnelStages();                

        return redirect()->route('settings');
    }

    private function updateFunnelModel()
    {
        $this->funnel->name = $this->funnelName;
        $this->funnel->save();
    }

    private function updateFunnelStages()
    {
        foreach ($this->removedStages as $stageId) {
            FunnelStage::find($stageId)->delete();
        }

        FunnelStage::upsert($this->inputs->all(), 'id');
    }
}
