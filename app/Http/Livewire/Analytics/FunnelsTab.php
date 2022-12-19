<?php

namespace App\Http\Livewire\Analytics;

use App\Models\Deal;
use App\Models\Funnel;
use Illuminate\Support\Carbon;
use Livewire\Component;

class FunnelsTab extends Component
{
    public $selectedFunnelId;
    public $maxDealsCount;

    public $dateFrom;
    public $dateTo; 

    private $dateTimeFrom;
    private $dateTimeTo;

    public function mount($dateFrom, $dateTo)
    {               
        $this->selectedFunnelId = Funnel::first()->id;    
        
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        
        $this->dateTimeFrom = Carbon::create($this->dateFrom);
        $this->dateTimeTo = Carbon::create($this->dateTo)->addHours(23)->addMinutes(59)->addSeconds(59);

        $this->maxDealsCount = Deal::where('closed_at', '<>', null)->get()
            ->whereBetween('created_at', [$this->dateTimeFrom, $this->dateTimeTo])
            ->count();            
    }

    public function render()
    {
        return view('livewire.analytics.funnels-tab', [
            'funnels' => Funnel::all(),
        ]);        
    }            

    public function getDealsCount($stageIndex)
    {
        $dealsCount = $this->funnel->deals
            ->whereBetween('created_at', [$this->dateTimeFrom, $this->dateTimeTo])
            ->whereNotNull('closed_at')
            ->where('stage', '>=', $stageIndex)
            ->count();                        

        if ($dealsCount > $this->maxDealsCount) {
            $this->maxDealsCount = $dealsCount;
        }

        return $dealsCount;
    }

    public function getPercentOfMaxDealsCount($stageIndex)
    {        
        return $this->getDealsCount($stageIndex) / $this->maxDealsCount * 100;
    }
    
    public function getFunnelProperty()
    {
        return Funnel::find($this->selectedFunnelId);
    }
    
    public function getDealsInProcessProperty()
    {        
        return $this->funnel->deals
            ->whereBetween('created_at', [$this->dateTimeFrom, $this->dateTimeTo])
            ->whereNull('closed_at');
    }

    public function getSuccessfulDealsProperty()
    {       
        return $this->funnel->deals
            ->whereBetween('created_at', [$this->dateTimeFrom, $this->dateTimeTo])
            ->whereNotNull('closed_at')
            ->where('success', true);
    }

    public function getFailedDealsProperty()
    {       
        return $this->funnel->deals
            ->whereBetween('created_at', [$this->dateTimeFrom, $this->dateTimeTo])
            ->whereNotNull('closed_at')
            ->where('success', false);
    }
}
