<x-app-layout>
  <x-slot:title>Изменить задачу</x-slot:title>
  <x-slot:brand>Задачи - {{ $task->title }} - Изменить</x-slot:brand>

  <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <input type="hidden" name="task" value="{{ $task->id }}">

    <div class="mb-3">
      <label for="title" class="form-label">Название</label>
      <input
      name="title"
      type="text" 
      class="form-control @error('title') is-invalid @enderror" 
      id="title"           
      value="{{ $task->title }}"      
      required> 
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Описание</label>
      <textarea name="description" class="form-control" id="description">{{ $task->description }}</textarea>
    </div>

    @can ('assign to task')
    <div class="mb-3">
      <label for="executor" class="form-label">Исполнитель</label>
      <select name="executor" class="form-select" id="executor">
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}" @selected($task->executor->is($employee))>
                {{ $employee->full_name }}
            </option>
        @endforeach
      </select>
    </div>
    @endcan

    <div class="d-flex flex-row mb-3">
      <div class="me-3">
        <label for="deadline">Крайний срок</label>
        <input 
        name="deadline"
        type="datetime-local"
        class="form-control @error('deadline') is-invalid @enderror"
        id="deadline" 
        min="{{ $task->deadline }}"
        step="any"
        value="{{ $task->deadline }}">
        @error('deadline')
          <div class="invalid-feedback">{{ $message }}</div>   
        @enderror
      </div>
      <div>
        <label for="deadline">Напоминание</label>
        <input 
        name="remind_at"
        type="datetime-local"
        class="form-control @error('remind_at') is-invalid @enderror"        
        min="{{ now() }}"
        step="any"
        value="{{ $task->remind_at }}">
        @error('remind_at')
          <div class="invalid-feedback">{{ $message }}</div>   
        @enderror
      </div>
    </div>    

    <div class="mb-3 d-flex flex-row align-items-end">
      <div>        
        <label for="deal">Сделка</label>      
        <select name="deal" class="form-select" id="deal">
          <option value="" @selected(!isset($task->deal))>Нет</option>
          @foreach ($deals as $deal)
            <option value="{{ $deal->id }}" @selected($task->deal?->is($deal))>
                {{ $deal->title }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="ms-3 me-3">или</div>
      <div>  
        <label for="client">Клиент</label>      
        <select name="client" class="form-select" id="client">
          <option value="" @selected(!isset($task->client))>Нет</option>
          @foreach ($clients as $client)
            <option value="{{ $client->id }}" @selected($task->client?->is($client))>
                {{ $client->full_name }}
            </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="mb-3">      
      <select name="priority" class="form-select" id="priority">
        <option value="">Приоритет</option>
        <option value="0" @selected($task->priority === 0)>Низкий</option>
        <option value="1" @selected($task->priority === 1)>Средний</option>
        <option value="2" @selected($task->priority === 2)>Высокий</option>        
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Подтвердить</button>
  </form>
</x-app-layout>