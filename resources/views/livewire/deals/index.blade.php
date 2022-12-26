<div>
  <x-slot:title>Сделки</x-slot:title>

  <nav class="navbar bg-white border border-1 rounded mt-4">
    <select wire:model='selectedFunnelId' class="form-select form-select-lg fw-semibold border-0 py-1" style="width: fit-content;">
      @foreach ($funnels as $funnel)
          <option value="{{ $funnel->id }}">
            {{ $funnel->name }}              
          </option>
      @endforeach    
    </select>
  </nav>  

  <div class="overflow-auto" style="max-height: 620px;">
    <div class="d-flex flex-row mt-3 mb-4">
      @foreach ($this->selectedFunnel->stages as $stage)
        <div class="me-3 bg-white" style="min-width: 290px;">
          <div class="p-2 border border-2 rounded shadow-sm">
            <div class="fw-semibold">{{ $stage->name }}</div>          
            <div class="d-flex flex-row justify-content-between">
              <div class="fw-light">Сделок: {{ $this->getDealsByStage($stage)->count() }}</div>
              <div class="fw-light">{{ $this->getSumByStage($stage) }} ₽</div>
            </div>        
          </div>
        </div>
      @endforeach
      <div class="me-3 bg-white" style="min-width: 290px;">
        <div class="p-2 border border-2 rounded shadow-sm">
          <div class="fw-semibold">Успешно реализовано</div>          
          <div class="d-flex flex-row justify-content-between">
            <div class="fw-light">Сделок: {{ $this->successfulDeals->count() }}</div>
            <div class="fw-light">{{ number_format($this->successfulDeals->sum('amount'), 2, ',', ' ') }} ₽</div>
          </div>        
        </div>
      </div>      
      <div class="me-3 bg-white" style="min-width: 290px;">
        <div class="p-2 border border-2 rounded shadow-sm">
          <div class="fw-semibold">Закрыто и не реализовано</div>          
          <div class="d-flex flex-row justify-content-between">
            <div class="fw-light">Сделок: {{ $this->failedDeals->count() }}</div>
            <div class="fw-light">{{ number_format($this->failedDeals->sum('amount'), 2, ',', ' ') }} ₽</div>
          </div>        
        </div>
      </div>      
    </div>
  
    <div class="d-flex flex-row">
      @foreach ($this->selectedFunnel->stages as $stage)            
        <div class="d-flex flex-column me-3" style="min-width: 290px;">
          @foreach ($this->getDealsByStage($stage) as $deal)        
            <livewire:deals.deal-card :deal="$deal">            
          @endforeach        
        </div>    
      @endforeach
      <div class="d-flex flex-column me-3" style="min-width: 290px;">
        @foreach ($this->successfulDeals as $deal)        
          <livewire:deals.deal-card :deal="$deal">            
        @endforeach        
      </div>
      <div class="d-flex flex-column me-3" style="min-width: 290px;">
        @foreach ($this->failedDeals as $deal)        
          <livewire:deals.deal-card :deal="$deal">
        @endforeach        
      </div>     
    </div>
  </div>

</div>
