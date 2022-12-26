<x-app-layout>
  <x-slot:title>Задачи</x-slot:title>
  <x-layouts.navbar :brand="'Задачи'"></x-layouts.navbar>


  <div class="row g-4 mt-1 mb-1">
    <div class="col-3">
      <div class="p-2 border rounded bg-danger bg-gradient text-white">
        <div class="d-flex flex-row justify-content-between">
          <div>Просроченные</div>
          <span class="badge text-bg-light">{{ $expiredTasks->count() }}</span>
        </div>        
      </div>
    </div>
    <div class="col-3">
      <div class="p-2 border rounded bg-success bg-gradient text-white">
        <div class="d-flex flex-row justify-content-between">
          <div>Сегодня в работе</div>
          <span class="badge text-bg-light">{{ $tasksToday->count() }}</span>
        </div>        
      </div>
    </div>
    <div class="col-3">
      <div class="p-2 border rounded bg-primary bg-gradient text-white">
        <div class="d-flex flex-row justify-content-between">
          <div>Завтра в работе</div>
          <span class="badge text-bg-light">{{ $tasksTomorrow->count() }}</span>
        </div>        
      </div>
    </div>
    <div class="col-3">
      <div class="p-2 border rounded bg-secondary bg-gradient text-white">
        <div class="d-flex flex-row justify-content-between">
          <div>Отложенные</div>
          <span class="badge text-bg-light">{{ $defferedTasks->count() }}</span>
        </div>        
      </div>
    </div>
  </div>

  <div class="row overflow-auto" style="max-height: 550px;">
    <div class="col-3">
      @foreach ($expiredTasks as $task)     
        <x-task-card :task="$task" />
      @endforeach
    </div>

    <div class="col-3">
      @foreach ($tasksToday as $task)      
        <x-task-card :task="$task" />
      @endforeach
    </div>

    <div class="col-3">
      @foreach ($tasksTomorrow as $task)      
        <x-task-card :task="$task" />
      @endforeach
    </div>

    <div class="col-3">
      @foreach ($defferedTasks as $task)      
        <x-task-card :task="$task" />
      @endforeach
    </div>
  </div>      
</x-app-layout>