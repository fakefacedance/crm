<div class="card shadow-sm mt-2 @if($task->priority == 2) border-danger @elseif($task->priority == 1) border-warning @endif">          
  <div class="card-body position-relative">
    <div class="position-absolute top-0 end-0 me-1">
      <a href="{{ route('tasks.edit', $task->id) }}" class="badge text-bg-primary">
        <i class="bi bi-pencil"></i>
      </a>      
      <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="badge text-bg-danger border-0">
          <i class="bi bi-trash"></i>
        </button>
      </form>            
    </div>
    <h5 class="card-title">{{ $task->title }}</h5>
      @if (isset($task->deal))
        <p>
          Сделка: <a href="{{ route('deals.show', $task->deal->id) }}" class="card-link">{{ $task->deal->title }}</a>
        </p>                
      @elseif (isset($task->client))
        <p>
          Клиент: 
          <a 
          href="{{ route('clients.show', $task->client->id) }}" 
          class="card-link">{{ $task->client->full_name }}</a>
        </p>
      @endif              
    <p class="card-text">{{ $task->description }}</p>            
  </div>
  <div class="card-footer text-muted">
    {{ App\Services\DatetimeService::formatted($task->deadline) }}
  </div>
</div>