<x-slot:title>Настройки</x-slot:title>
<x-layouts.navbar :brand="'Настройки'"></x-layouts.navbar>

<div>
  <nav class="mt-3">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button wire:click="$emit('funnels-tab-selected')" class="nav-link active" id="nav-funnels-tab" data-bs-toggle="tab" data-bs-target="#nav-funnels" type="button" role="tab">Воронки</button>
      <button wire:click="$emit('roles-tab-selected')" class="nav-link" id="nav-roles-tab" data-bs-toggle="tab" data-bs-target="#nav-roles" type="button" role="tab">Роли и права</button>
      <button wire:click="$emit('telegram-tab-selected')" class="nav-link" id="nav-tg-tab" data-bs-toggle="tab" data-bs-target="#nav-telegram" type="button" role="tab">Telegram</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-funnels" role="tabpanel" tabindex="0">
      <livewire:settings.funnels-tab></livewire:settings.funnels>
    </div>
    <div class="tab-pane fade" id="nav-roles" role="tabpanel" tabindex="1">
      <livewire:settings.roles-tab></livewire:settings.roles>
    </div>
    <div class="tab-pane fade" id="nav-telegram" role="tabpanel" tabindex="2">
      <livewire:settings.telegram-tab />
    </div>
  </div>
</div>