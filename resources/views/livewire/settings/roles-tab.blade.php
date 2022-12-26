<div>
  <div class="row g-3 mt-1">
    @can('add role')
    <div class="mt-3">
      <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm">Добавить</a>
    </div>      
    @endcan       
    @foreach ($roles as $role)
      <div class="col-4">        
        <div class="bg-white p-3 border rounded nav-link position-relative shadow">
          <div class="position-absolute top-0 end-0 me-2 mt-2">
            @can('edit role') 
              <a href="{{ route('roles.edit', $role->id) }}" class="badge text-bg-primary">
                <i class="bi bi-pencil"></i>
              </a> 
            @endcan
            @can('delete role')              
              <button wire:click='deleteRole({{ $role }})' class="badge text-bg-danger border-0">
                <i class="bi bi-trash"></i>
              </button>
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
