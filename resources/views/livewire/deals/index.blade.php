<div>
  <x-slot:title>Сделки</x-slot:title>

  <nav class="navbar bg-white border border-1 rounded mt-4">
    <select wire:model='selectedFunnel.id' wire:change="$emit('funnelSelected')" class="form-select form-select-lg fw-semibold border-0 py-1" style="width: fit-content;">
      @foreach ($funnels as $funnel)
          <option value="{{ $funnel->id }}">
            {{ $funnel->name }}              
          </option>
      @endforeach    
    </select>
  </nav>  

  <div class="overflow-auto">  
    <div class="d-flex flex-row mt-3 mb-4">
      @foreach ($selectedFunnel->stages as $stage)
        <div class="me-3 bg-white" style="min-width: 290px;">
          <div class="p-2 border border-2 rounded shadow-sm">
            <div class="fw-semibold">{{ $stage->name }}</div>          
            <div class="d-flex flex-row justify-content-between">
              <div class="fw-light">Сделок: {{ $selectedFunnel->deals->where('stage', $stage->index)->count() }}</div>
              <div class="fw-light">Сумма: {{ $selectedFunnel->deals->where('stage', $stage->index)->sum('amount')}} ₽</div>
            </div>        
          </div>
        </div>
      @endforeach        
    </div>
  
    <div class="d-flex flex-row">
      @foreach ($selectedFunnel->stages as $stage)            
        <div class="d-flex flex-column me-3" style="min-width: 290px;">
          @foreach ($selectedFunnel->deals->where('stage', $stage->index) as $deal)        
            <a href="{{ route('deals.show', $deal->id) }}" class="mt-2 p-2 border rounded nav-link bg-white shadow-sm" style="min-width: 290px;">         
              <div class="fw-semibold">{{ $deal->title }}</div>        
              <object>
              <a href="{{ route('clients.show', $deal->client->id) }}" class="fw-light">
                {{ $deal->client->full_name }}
              </a>  
              </object>     
              <div class="d-flex flex-row justify-content-end">                
                <div class="fw-light">{{ $deal->amount }} ₽</div>
              </div>        
            </a>            
          @endforeach        
        </div>    
      @endforeach      
    </div>
  </div>

</div>
