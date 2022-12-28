<a href="{{ route('deals.show', $deal->id) }}" class="mt-2 p-2 border rounded nav-link bg-white shadow-sm" style="min-width: 290px;">         
  <div class="fw-semibold">{{ $deal->title }}</div>        
  @if (isset($deal->client))
    <object>
      <a href="{{ route('clients.show', $deal->client->id) }}" class="fw-light">
        {{ $deal->client->full_name }}
      </a>
    </object>
  @else
    <div class="text-danger">Клиент не привязан</div>
  @endif
  <div class="d-flex flex-row justify-content-end">                
    <div class="fw-light">{{ $this->amountFormatted }} ₽</div>
  </div>        
</a>