<x-app-layout>
  <x-slot:title>Создать задачу</x-slot:title>
  <x-slot:brand>Задачи - Создать</x-slot:brand>

  <form action="{{ route('tasks.store') }}" method="POST" class="mt-3">
    @csrf

    <div class="mb-3">
      <label for="title" class="form-label">Название</label>
      <input
      name="title"
      type="text" 
      class="form-control @error('title') is-invalid @enderror" 
      id="title"           
      value="{{ old('title') }}"      
      required> 
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Описание</label>
      <textarea name="description" class="form-control" id="description" rows="2"></textarea>
    </div>

    @can ('assign to task')
    <div class="mb-3">
      <label for="executor" class="form-label">Исполнитель</label>
      <select name="executor" class="form-select" id="executor">
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}" @selected(auth()->user()->id === $employee->id)>
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
        min="{{ now() }}"
        step="any">
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
        step="any">
        @error('remind_at')
          <div class="invalid-feedback">{{ $message }}</div>   
        @enderror
      </div>
    </div>
    
    <div class="mb-3 d-flex flex-row align-items-end">
      <div>        
        <label for="deal">Сделка</label>
        <select name="deal" class="form-select" id="deal">
          <option value="" selected>Нет</option>
          @foreach ($deals as $deal)
              <option value="{{ $deal->id }}">
                  {{ $deal->title }}
              </option>
          @endforeach
        </select>
      </div>
      <div class="ms-3 me-3">или</div>
      <div>     
        <label for="client">Клиент</label>   
        <select name="client" class="form-select" id="client">
          <option value="" selected>Нет</option>
          @foreach ($clients as $client)
              <option value="{{ $client->id }}">
                  {{ $client->full_name }}
              </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="mb-3">      
      <select name="priority" class="form-select" id="priority">
        <option value="" disabled selected>Приоритет</option>
        <option value="0">Низкий</option>
        <option value="1">Средний</option>
        <option value="2">Высокий</option>        
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>
</x-app-layout>