<?php

namespace App\Http\Livewire\Settings;

use App\Models\Funnel;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateFunnel extends Component
{
    public Collection $inputs;
    public $funnelName;

    public function render()
    {
        return view('livewire.settings.create-funnel');
    }

    public function mount()
    {
        $this->inputs = collect([]);
    }

    public function addInput()
    {
        $this->inputs->push([
            'name' => '',
            'index' => $this->inputs->count(),
        ]);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    public function store()
    {
        $this->validate();

        $funnel = $this->insertFunnel();
        $this->insertFunnelStages($funnel);

        return redirect()->route('settings');
    }

    protected function rules()
    {
        return [
            'funnelName' => 'required',
            'inputs.*.name' => 'required',
            'inputs.*.index' => ['required', 'distinct', 'numeric', 'max:' . $this->inputs->count() - 1],
        ];
    }

    private function insertFunnel()
    {
        return Funnel::create([
            'name' => $this->funnelName,
        ]);
    }

    private function insertFunnelStages(Funnel $funnel)
    {
        $funnelStages = $this->inputs->map(function ($item, $key) use ($funnel) {
            $item['funnel_id'] = $funnel->id;

            return $item;
        });

        $funnel->stages()->createMany($funnelStages->toArray());
    }
}
