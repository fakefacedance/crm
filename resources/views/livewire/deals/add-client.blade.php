<div>
  @if ($buttonClicked)
    <div>           
      <select wire:model='clientId' class="form-select">
        <option hidden>Клиент</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">
                {{ $client->full_name }}
            </option>
        @endforeach
      </select>
    </div>
    <button wire:click='submit' class="btn btn-primary mt-3">Подтвердить</button>
  @else
    <button wire:click='addClientOnClick' class="d-flex flex-row align-items-center border-0 bg-transparent">
      <i class="bi bi-person-plus fs-3"></i>
      <div class="ms-2">Прикрепить клиента</div>
    </button>
  @endif
</div>
