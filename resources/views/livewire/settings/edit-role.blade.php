<x-slot:title>Настройки - Роли и права - {{ $role->name }} - Изменить</x-slot:title>
<x-slot:brand>Настройки - Роли и права - {{ $role->name }} - Изменить</x-slot:brand>

<form wire:submit.prevent="update">
  <div class="mt-3">
    <label for="role-name" class="form-label">Название</label>
    <input 
    wire:model='roleName'
    name="role-name"
    type="text" 
    class="form-control @error('role-name') is-invalid @enderror" 
    id="role-name"               
    required> 
    @error('role-name')
      <div class="invalid-feedback">{{ $message }}</div>   
    @enderror      
  </div>

  <div class="d-flex flex-column flex-wrap mt-3" style="max-height: 25rem">
    @foreach ($permissions as $permission)
      <div class="form-check">
        <input 
        wire:model="inputs.{{ $permission->id }}" 
        class="form-check-input" 
        type="checkbox" 
        id="checkbox_{{ $permission->id }}" 
        checked>
        <label class="form-check-label" for="checkbox_{{ $permission->id }}">
          {{ $permission->name }}
        </label>
      </div>        
    @endforeach
  </div>  

  <button type="submit" class="btn btn-primary mt-3">Подтвердить</button>
</div>
