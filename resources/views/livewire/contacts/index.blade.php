<div>
  <x-slot:title>Контакты</x-slot:title>
  <x-layouts.navbar :brand="'Контакты'"></x-layouts.navbar>    
  
  <ul class="nav nav-tabs mt-3">
    <li class="nav-item">
      <button wire:click='clientsTabOnClick' class="nav-link {{ $clientsTabSelected ? 'active' : '' }}">Клиенты</button>
    </li>
    <li class="nav-item">
      <button wire:click='managersTabOnClick' class="nav-link {{ $managersTabSelected ? 'active' : '' }}">Сотрудники</button>
    </li>    
  </ul>
  
  @if ($clientsTabSelected)
    <livewire:contacts.clients-tab wire:key="{{ now() }}">
  @elseif ($managersTabSelected)
    <livewire:contacts.employees-tab wire:key="{{ now() }}">
  @endif
</div>
