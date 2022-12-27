@isset($this->lead)
  <div class="bg-white border rounded p-3 lh-1 h-100">
    <div class="d-flex flex-column overflow-auto h-100" id="chat">
      @foreach ($this->messages as $message)
        <div class="mb-1 d-flex flex-row @if($message['correspondent_type'] == 'client') justify-content-start @else justify-content-end @endif">
          <div class="border rounded p-2 shadow-sm" style="max-width: 50%;">
            <span class="fw-semibold">{{ $message['correspondent_name'] }}</span>
            <div class="d-flex flex-row align-items-end justify-content-between">
              <div class="text-break">{{ $message['text'] }}</div>
              <small class="fw-light ms-1">{{ App\Services\DatetimeService::formatted($message['sent_at'], 'HH:ss') }}</small>
            </div>          
          </div>
        </div>      
      @endforeach
      <div class="mt-auto">
        <div class="d-flex flex-row align-items-end">
          <textarea wire:model='messageToSend' wire:keydown.enter.prevent='sendMessage' class="form-control" rows="1"></textarea>
          <div>
            <button wire:click='sendMessage' class="btn btn-primary ms-1">
              <i class="bi bi-send"></i>
            </button>
          </div>      
        </div>    
      </div>      
    </div>    
  </div>
@endisset