<div>
  <div class="row g-3 mt-1">
    @can('add funnel')
    <div class="mt-3">
      <a href="{{ route('funnels.create') }}" class="btn btn-success btn-sm">Добавить</a>
    </div>      
    @endcan       
    @foreach ($funnels as $funnel)
      <div class="col-4">        
        <div class="p-3 border rounded nav-link position-relative">
          <div class="position-absolute top-0 end-0 me-2 mt-2">
            @can('edit funnel') 
              <a href="{{ route('funnels.edit', $funnel->id) }}" class="btn btn-primary btn-sm">Изменить</a> 
            @endcan
            @can('delete funnel')              
              <button wire:click='deleteFunnel({{$funnel}})' class="btn btn-danger btn-sm">Удалить</button>
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
