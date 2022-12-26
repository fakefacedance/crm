<div>
  <x-slot:title>Настройки</x-slot:title>
  <x-layouts.navbar :brand="'Настройки'"></x-layouts.navbar>
  
  <nav class="mt-3">
    <div class="nav nav-tabs">
      <button wire:click="funnelsTabOnClick" class="nav-link {{$funnelsTabSelected ? 'active' : ''}}">Воронки</button>
      <button wire:click="rolesTabOnClick" class="nav-link {{$rolesTabSelected ? 'active' : ''}}">Роли и права</button>
      <button wire:click="telegramTabOnClick" class="nav-link {{$telegramTabSelected ? 'active' : ''}}">Telegram</button>
    </div>
  </nav>
  @if ($funnelsTabSelected)
    <livewire:settings.funnels-tab>
  @elseif ($rolesTabSelected)
    <livewire:settings.roles-tab>
  @else
    <livewire:settings.telegram-tab>
  @endif
</div>