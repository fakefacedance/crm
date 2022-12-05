<div>
  <div class="row g-3 mt-1">
    @foreach ($clients as $client)
      <div class="col-4">
        <a href="{{ route('clients.show', $client->id) }}" class="p-3 border rounded nav-link">
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
    {!! $clients->links() !!}
  </div>
</div>
