<div>
  @can('add client')
  <div class="mt-3">
    <a href="{{ route('clients.create') }}" class="btn btn-success btn-sm">+ Добавить</a>
  </div>    
  @endcan
  <div class="row g-3 mt-1">
    @foreach ($clients as $client)
      <div class="col-4">
        <a href="{{ route('clients.show', $client->id) }}" class="bg-white p-3 border rounded nav-link shadow" style="min-height: 82px;">
          <div class="fw-semibold">
            {{ $client->full_name }}
          </div>          
          <div>
            {{ $client->phone_number }}
          </div>          
        </a>
      </div>
    @endforeach            
  </div>
  <div class="d-flex justify-content-start mt-3">
    {{ $clients->links() }}
  </div>
</div>
