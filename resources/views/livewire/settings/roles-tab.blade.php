<div>
  <div class="row g-3 mt-1">
    @can('add role')
    <div class="mt-3">
      <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm">Добавить</a>
    </div>      
    @endcan       
    @foreach ($roles as $role)
      <div class="col-4">        
        <div class="p-3 border rounded nav-link position-relative">
          <div class="position-absolute top-0 end-0 me-2 mt-2">
            @can('edit role') 
              <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Изменить</a> 
            @endcan
            @can('delete role')              
              <button wire:click='deleteRole({{ $role }})' class="btn btn-danger btn-sm">Удалить</button>
            @endcan            
          </div>
          <div class="fw-semibold">
            {{ $role->name }}            
          </div>          
          <div class="fw-light">
            Прав: {{ $role->permissions->count() }}
          </div>
        </div>        
      </div>
    @endforeach            
  </div>
  <div class="d-flex justify-content-start mt-3">
    {{ $roles->links() }}
  </div>
</div>
