<div>  
  @if ($this->apiTokenIsSet())
  <div class="row ms-0 mt-3">
    <div class="col-6 border rounded bg-white p-3">
      <div class="d-flex flex-row align-items-center">
        <div class="fw-semibold">{{ $this->botName }}</div>
        @if ($this->botIsActive())
          <span class="badge bg-success ms-auto">Активен</span>
        @else
          <span class="badge bg-danger ms-auto">Неактивен</span>
        @endif        
      </div>    
      <a href="https://t.me/{{$this->botUsername}}" class="text-primary nav-link">
        {{ $this->botUsername ? '@'.$this->botUsername : '' }}
      </a>
      <div class="mt-3">
        API-токен:
        <span class="font-monospace">{{ config('telebot.bots.bot.token') }}</span>
      </div>
    </div>
  </div>  
  @endif
</div>
