<div>
    <x-slot:title>Входящие лиды</x-slot:title>
    <x-layouts.navbar :brand="'Входящие лиды'" />

    @if ($this->leads->isNotEmpty())
      <div class="row mt-3">
        <div class="col-4">
          <div class="list-group">
            @foreach ($this->leads as $lead)
              <button wire:click='selectLead({{$lead->id}})' class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <div class="mb-1">{{ $lead->correspondent_name }} <i class="bi bi-telegram"></i></div>
                  <small>{{ Illuminate\Support\Carbon::create($lead->sent_at)->isoFormat('DD.MM.YYYY') }}</small>
                </div>
                <p class="mb-1 text-truncate">{{ $lead->text }}</p>
              </button>
            @endforeach            
          </div>
        </div>
        <div class="col-8">
          <div style="height: 550px;">
            <livewire:incoming-leads.chat :leadId="$this->selectedLead->id" wire:key="{{ now() }}">
          </div>          
          <div class="d-flex flex-row justify-content-center mt-3">
            <button wire:click='acceptLead' class="btn btn-primary me-3">
              <i class="bi bi-check-circle"></i>
              Принять
            </button>
            <button wire:click='declineLead' class="btn btn-secondary">
              <i class="bi bi-x-circle"></i>
              Отклонить
            </button>
          </div>
        </div>
      </div>
    @else
      <div class="d-flex align-items-center justify-content-center p-3 mt-3 border rounded bg-white" style="min-height: 85vh;">
        <h5>Нет сообщений 😌</h5>
      </div>
    @endif

</div>
