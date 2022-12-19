<div>
  <x-slot:title>Сделки - {{ $deal->title }}</x-slot:title>
  <x-layouts.navbar :brand="'Сделки - '.$deal->title"></x-layouts.navbar>

  <div class="card mt-3">
    <div class="card-header">
      <div class="row">
        <div class="col-4 align-self-center">
          @if (!$editModeEnabled)
            <div class="fs-5 fw-semibold text-black">
              {{ $deal->title }}
            </div>
          @else
            <input type="text" wire:model.defer="tempDeal.title" class="form-control fs-5 fw-semibold">
          @endif                        
        </div>
        <div class="col-8">
          <div class="d-flex flex-row justify-content-between align-items-center">
            <ul class="nav nav-pills card-header-pills">              
              <li class="nav-item">
                <button wire:click="$emit('tabSelected', 'tasks')" class="nav-link @if($selectedTab == 'tasks') active @endif" href="#">Задачи</button>
              </li>                          
              <li class="nav-item">
                <button wire:click="$emit('tabSelected', 'chat')" class="nav-link disabled">Чат</button>
              </li>
            </ul>
            @can('update', $deal)
              @if ($editModeEnabled)
              <div>
                <button wire:click="saveChanges" type="button" class="btn btn-primary">
                  Сохранить
                </button>
                <button wire:click="$emit('editModeToggle')" type="button" class="btn btn-secondary">
                  Закрыть
                </button>
              </div>                
              @else            
                <div class="fs-5">                
                  <a href="{{ route('deals.custom_fields', $deal->id) }}" class="badge text-bg-success">
                    <i class="bi bi-gear"></i>
                  </a>
                  <button wire:click="$emit('editModeToggle')" class="badge text-bg-primary border-0">
                    <i class="bi bi-pencil"></i>
                  </button>      
                  <form action="{{ route('deals.destroy', $deal->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge text-bg-danger border-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Удалить">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              @endif
            @endcan                         
          </div>            
        </div>
      </div>        
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-4">
          <div class="mb-2 d-flex flex-row justify-content-between">     
            <div>
              <label for="funnel">Воронка</label>   
              <select 
              wire:model='tempDeal.funnel_id'
              wire:change="$emit('funnelSelected')" 
              name="funnel" 
              class="form-select form-select-sm"
              @if (!$editModeEnabled) disabled @endif>
                @foreach ($funnels as $funnel)
                  <option value="{{ $funnel->id }}">
                    {{ $funnel->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div>
              <label for="funnel">Стадия</label>
              <select 
              wire:model="tempDeal.stage" 
              name="funnel_stage" 
              class="form-select form-select-sm"
              @if (!$editModeEnabled) disabled @endif>      
                @foreach ($funnelStages as $stage)
                  <option value="{{ $stage->index }}">
                    {{ $stage->name }}
                  </option>
                @endforeach                
                <option value="{{ $successStageIndex }}">Успешно реализовано</option>
                <option value="{{ $failStageIndex }}">Закрыто и не реализовано</option>
              </select>
            </div>
          </div>                         
          <div class="mb-2">
            <label for="amount" class="form-label">Сумма</label>
            <input
            wire:model="tempDeal.amount"
            type="number"
            name="amount"                  
            class="form-control form-control-sm @error('tempDeal.amount') is-invalid @enderror" 
            min="0"
            max="99999999.99"
            step="0.01"                            
            @if (!$editModeEnabled) disabled @endif>
            @error('tempDeal.amount')
              <div class="invalid-feedback">{{ $message }}</div>   
            @enderror      
          </div>            
          @if ($customFields->isNotEmpty()) <hr> @endif
          <div class="overflow-auto" style="max-height: 104px;">
            @foreach ($customFields as $customField)
              @if ($loop->last)
                <div class="row w-100">
                  <div class="col-6 text-start fw-semibold">{{ $customField->name }}:</div> 
                  <div class="col-6 text-start">{{ $customField->value }}</div>
                </div>
                @break
              @endif
              <div class="row w-100">
                <p class="col-6 text-start fw-semibold">{{ $customField->name }}:</p> 
                <p class="col-6 text-start">{{ $customField->value }}</p>
              </div>
            @endforeach
          </div>  
          @if ($customFields->isNotEmpty()) <hr> @endif
          <div class="mb-3">
            <label for="employee">Ответственный</label>
            <select 
            wire:model="employeeId"
            name="employee" 
            class="form-select form-select-sm"
            @if (!$editModeEnabled) disabled @endif>      
              @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">
                  {{ $employee->full_name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="card">
            <div class="card-header">
              <a href="{{ route('clients.show', $deal->client->id) }}" class="nav-link">
                {{ $deal->client->full_name }}
              </a>                
            </div>
            <div class="card-body">                
              <p class="card-text">Телефон: {{ $deal->client->phone_number }}</p>
              @isset($deal->client->email)
                <p class="card-text">Почта: {{ $deal->client->email }}</p>                
              @endisset                
            </div>
          </div>            
        </div>

        <div class="col-8">
          @if ($selectedTab == 'tasks')
          <div class="row gy-2 overflow-auto" style="max-height: 473px;">
            @foreach ($deal->tasks as $task)
              <livewire:deals.task :task="$task" wire:key="task-{{$task->id}}">
            @endforeach
          </div>              
          @elseif ($selectedTab == 'chat')
            ...
          @endif
        </div>
      </div>
      
    </div>
    <div class="card-footer text-muted">
      Дата создания: {{ App\Services\DatetimeService::formatted($deal->created_at) }}
    </div>
  </div>  
</div>
