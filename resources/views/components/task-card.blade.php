<div class="card shadow-sm mt-2 @if($task->priority == 2) border-danger @elseif($task->priority == 1) border-warning @endif">          
  <div class="card-body">
    <h5 class="card-title">{{ $task->title }}</h5>
      @if (isset($task->deal))
        <p>
          Сделка: <a href="#" class="card-link">{{ $task->deal->title }}</a>
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
  <div class="card-footer text-muted">{{ $task->deadlineFormatted() }}</div>
</div>