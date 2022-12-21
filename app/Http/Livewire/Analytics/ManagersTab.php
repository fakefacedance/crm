<?php

namespace App\Http\Livewire\Analytics;

use App\Models\Staff;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ManagersTab extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $dateFrom;
    public $dateTo;

    public function mount($dateFrom, $dateTo)
    {
        $this->dateFrom = Carbon::create($dateFrom);
        $this->dateTo = Carbon::create($dateTo)->addHours(23)->addMinutes(59)->addSeconds(59);
    }

    public function render()
    {
        return view('livewire.analytics.managers-tab', [
            'managers' => Staff::paginate(10)
        ]);
    }

    public function getDealsCount($manager)
    {
        return $manager->deals
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->count();
    }

    public function getUniqueClientsCount($manager)
    {
        $clients = $manager->deals
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->map(function ($deal, $key) {
                return $deal->client;
            });

        return $clients->unique()->count();
    }

    public function getFailedDealsCount($manager)
    {
        return $manager->deals
            ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
            ->whereNotNull('closed_at')
            ->where('success', false)
            ->count();
    }

    public function getFailedDealsPercent($manager)
    {
        $dealsCount = $this->getDealsCount($manager);
        if ($dealsCount === 0) return 0;

        $percent = $this->getFailedDealsCount($manager) / $this->getDealsCount($manager) * 100;

        return number_format($percent, 2, ',', ' ');
    }

    public function getAverageReceipt($manager)
    {        
        $avg = $manager->deals
        ->whereBetween('created_at', [$this->dateFrom, $this->dateTo])
        ->average('amount');

        return number_format($avg, 2, ',', ' ');
    }
}
