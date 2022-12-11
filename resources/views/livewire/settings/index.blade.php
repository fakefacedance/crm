<x-slot:title>Настройки</x-slot:title>
<x-slot:brand>Настройки</x-slot:brand>

<div>
  <nav class="mt-3">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button wire:click="$emit('funnels-tab-selected')" class="nav-link active" id="nav-funnels-tab" data-bs-toggle="tab" data-bs-target="#nav-funnels" type="button" role="tab">Воронки</button>
      <button wire:click="$emit('roles-tab-selected')" class="nav-link" id="nav-roles-tab" data-bs-toggle="tab" data-bs-target="#nav-roles" type="button" role="tab">Роли и права</button>      
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-funnels" role="tabpanel" aria-labelledby="nav-funnels-tab" tabindex="0">
      <livewire:settings.funnels-tab></livewire:settings.funnels>
    </div>
    <div class="tab-pane fade" id="nav-roles" role="tabpanel" aria-labelledby="nav-roles-tab" tabindex="0">
      <livewire:settings.roles-tab></livewire:settings.roles>
    </div>    
  </div>
</div>