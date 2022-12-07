<x-app-layout>
  <x-slot:title>{{ $employee->full_name }}</x-slot:title>
  <x-slot:brand>Контакты 🠖 {{ $employee->full_name }}</x-slot:brand>
    
  @can('edit employee')
    <a href="{{ route('staff.edit', $employee->id) }}" class="btn btn-primary btn-sm mt-3">Изменить</a>
  @endcan
  
  @can('delete employee')
    <form action="{{ route('staff.destroy', $employee->id) }}" method="POST" class="d-inline-block">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm mt-3">Удалить</button>
    </form>
  @endcan  

  <div class="card text-center mt-3">
    <div class="card-header">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="credentials-tab" data-bs-toggle="tab" data-bs-target="#credentials-tab-pane" type="button" role="tab" aria-controls="credentials-tab-pane" aria-selected="true">Учетные данные</button>
        </li>
        <li class="nav-item" role="presentation">          
          <button class="nav-link" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks-tab-pane" type="button" role="tab" aria-controls="tasks-tab-pane" aria-selected="false" @disabled($tasks->isEmpty())>Задачи</button>
        </li> 
        <li class="nav-item" role="presentation">          
          <button class="nav-link" id="deals-tab" data-bs-toggle="tab" data-bs-target="#deals-tab-pane" type="button" role="tab" aria-controls="deals-tab-pane" aria-selected="false" @disabled($deals->isEmpty())>Сделки</button>
        </li>    
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="credentials-tab-pane" role="tabpanel" aria-labelledby="credentials-tab" tabindex="0">
          <div class="row">
            <p class="col-2 text-start fw-semibold">ФИО:</p> 
            <p class="col-3 text-start">{{ $employee->full_name }}</p>
          </div>
          <div class="row">
            <p class="col-2 text-start fw-semibold">Роль(и):</p> 
            <p class="col-3 text-start">{{ $employee->getRoleNames()->join(', ') }}</p>
          </div>
          <div class="row">
            <p class="col-2 text-start fw-semibold">Должность:</p> 
            <p class="col-3 text-start">{{ $employee->position }}</p>
          </div>
          <div class="row">
            <p class="col-2 text-start fw-semibold">Номер телефона:</p> 
            <p class="col-3 text-start">{{ $employee->phone_number }}</p>
          </div>
          <div class="row">
            <p class="col-2 text-start fw-semibold">Email:</p> 
            <p class="col-3 text-start">{{ $employee->email }}</p>
          </div>                            
          <div class="row">
            <p class="col-2 text-start fw-semibold">Дата создания:</p> 
            <p class="col-3 text-start">{{ \Carbon\Carbon::parse($employee->created_at)->format('d.m.Y H:i:s') }}</p>
          </div>          
        </div>

        <div class="tab-pane fade" id="tasks-tab-pane" role="tabpanel" aria-labelledby="tasks-tab" tabindex="0">
          <table class="table table-sm text-start">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Приоритет</th>
                <th scope="col">Клиент</th>
                <th scope="col">Сделка</th>
                <th scope="col">Кто поставил</th>
                <th scope="col">Крайний срок</th>
                {{-- <th scope="col">Завершена</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $index => $task)
                <tr @if($task->isExpired()) class="table-danger" @elseif($task->is_completed) class="table-success" @endif>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td>{{ $task->title }}</td>
                  <td>{{ $task->getPriorityName() }}</td>
                  <td>
                    @if(isset($task->client))
                      <a href="{{ route('clients.show', $task->client->id) }}">{{ $task->client->full_name }}</a>
                    @else
                      Нет
                    @endif                                        
                  </td>
                  <td>
                    @if(isset($task->deal))
                      {{-- <a href="{{ route('deals.show', $task->deal_id) }}">{{ $task->deal->title }}</a> --}}
                      <a href="#">{{ $task->deal->title }}</a>
                    @else
                      Нет
                    @endif                                        
                  </td>
                  <td>
                    <a href="{{ route('staff.show', $task->assigner_id) }}">{{ $task->assigner->full_name }}</a>
                  </td>
                  <td>{{ \Carbon\Carbon::parse($task->deadline)->format('d.m.Y H:i:s') }}</td>
                  {{-- <td>{{ $task->is_completed ? 'Да' : 'Нет' }}</td> --}}
                </tr>
              @endforeach                
            </tbody>            
          </table>
          <div class="d-flex justify-content-start mt-3">
            {!! $tasks->links() !!}
          </div>                          
        </div>

        <div class="tab-pane fade" id="deals-tab-pane" role="tabpanel" aria-labelledby="deals-tab" tabindex="0">
          <table class="table text-start">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Клиент</th>
                <th scope="col">Воронка</th>
                <th scope="col">Стадия</th>
                <th scope="col">Сумма</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($deals as $index => $deal)
                <tr @if($deal->stage === 4) class="table-danger" @elseif($deal->stage === 3) class="table-success" @endif>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td>{{ $deal->title }}</td>
                  <td>
                    <a href="{{ route('clients.show', $deal->client->id) }}">{{ $deal->client->full_name }}</a>                    
                  </td>
                  <td>{{ $deal->funnel->name }}</td>
                  <td>{{ $deal->getStage()->name }}</td>                  
                  <td>{{ $deal->amount }} ₽</td>
                </tr>
              @endforeach                            
            </tbody>
          </table>
          <div class="d-flex justify-content-start mt-3">
            {!! $deals->links() !!}
          </div>
        </div>    
      </div>
    </div>
  </div>
</x-app-layout>