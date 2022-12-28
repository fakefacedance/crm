<x-slot:title>Настройки - Воронки - {{ $funnel->name }} - Изменить</x-slot:title>
<x-slot:brand>Настройки - Воронки - {{ $funnel->name }} - Изменить</x-slot:brand>

<div>  
  <div class="mt-3">
    <label for="funnelName" class="form-label">Название</label>
    <input 
    wire:model.defer="funnelName"
    name="funnelName"
    type="text" 
    class="form-control @error('funnelName') is-invalid @enderror" 
    id="funnelName"                 
    required> 
    @error('funnelName')
      <div class="invalid-feedback">{{ $message }}</div>   
    @enderror      
  </div>
  
  <button wire:click="addInput" class="btn btn-success mt-3">Добавить этап</button>

  @if ($inputs->isNotEmpty())
      <div class="row g-3 mt-1">
        <div class="col">Название этапа</div>
        <div class="col-2">Порядковый номер</div>
        <div class="col"></div>
      </div>
  @endif
  
  @foreach ($inputs as $key => $item)
  <div class="row g-3 mt-1">
    <div class="col">
      <input type="text" id="input_{{ $key }}_name" wire:model.defer="inputs.{{ $key }}.name" class="form-control @error('inputs.'.$key.'.name') is-invalid @enderror" placeholder="Название" autocomplete="off">      
      @error('inputs.'.$key.'.name') <span class="invalid-feedback">{{ $message }}</span> @enderror      
    </div>
    <div class="col-2">      
      <input type="number" id="input_{{ $key }}_index" wire:model.defer="inputs.{{ $key }}.index" min="0" max="{{ $inputs->count() - 1 }}" class="form-control @error('inputs.'.$key.'.index') is-invalid @enderror" autocomplete="off">
      @error('inputs.'.$key.'.index') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>    
    <div class="col">
      <button wire:click="removeInput({{ $key }})" class="btn btn-danger">Удалить</button>
    </div>
  </div>  
  @endforeach  

  <button wire:click="update" class="btn btn-primary mt-3 d-block">Подтвердить</button>
</div>
