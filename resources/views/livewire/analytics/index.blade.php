<div>
  <x-slot:title>Аналитика</x-slot:title>
  <x-layouts.navbar :brand="'Аналитика'" />

  <ul class="nav nav-pills mt-3 justify-content-between">
    <li class="nav-item">
      <button class="nav-link {{ $funnelsTabSelected ? 'active' : ''}}">Воронки</button>
    </li>
    <li class="nav-item">
      <button class="nav-link {{ $managersTabSelected ? 'active' : ''}}">Менеджеры</button>
    </li>
    <li class="nav-item ms-auto">      
      <div class="d-flex flex-row align-items-center">
        <input wire:model="dateFrom" {{-- wire:change="dateFromChanged" --}} type="date" class="form-control">
        <i class="bi bi-arrow-right ms-3 me-3 fs-4"></i>
        <input wire:model="dateTo" {{-- wire:change="dateToChanged" --}} type="date" min="{{ $dateFrom }}" class="form-control">
      </div>      
    </li>  
  </ul>  
  
  @if ($funnelsTabSelected)
    <livewire:analytics.funnels-tab wire:key="{{ now() }}" :dateFrom="$dateFrom" :dateTo="$dateTo">
  @elseif ($managersTabSelected)
    <livewire:analytics.managers-tab wire:key="{{ now() }}" :dateFrom="$dateFrom" :dateTo="$dateTo">
  @endif
</div>
