<div>
  <div class="row g-3 mt-1">
    @can('add funnel')
    <div class="mt-3">
      <a href="{{ route('funnels.create') }}" class="btn btn-success btn-sm">Добавить</a>
    </div>      
    @endcan       
    @foreach ($funnels as $funnel)
      <div class="col-4">        
        <div class="p-3 border bg-white rounded nav-link position-relative shadow">
          <div class="position-absolute top-0 end-0 me-2 mt-2">
            @can('edit funnel') 
              <a href="{{ route('funnels.edit', $funnel->id) }}" class="badge text-bg-primary">
                <i class="bi bi-pencil"></i>
              </a> 
            @endcan
            @can('delete funnel')              
              <button wire:click='deleteFunnel({{ $funnel }})' class="badge text-bg-danger border-0">
                <i class="bi bi-trash"></i>
              </button>
            @endcan            
          </div>
          <div class="fw-semibold">
            {{ $funnel->name }}            
          </div>          
          <div class="fw-light">
            Стадий: {{ $funnel->stages->count() }}
          </div>
        </div>        
      </div>
    @endforeach            
  </div>
  <div class="d-flex justify-content-start mt-3">
    {{ $funnels->links() }}
  </div>
</div>
