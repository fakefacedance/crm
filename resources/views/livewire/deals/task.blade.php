<div class="border rounded p-2 @if ($task->priority == 2) border-danger @elseif ($task->priority == 1 ) border-warning @endif">
  <div class="d-flex flex-row justify-content-between">
    <div class="form-check">
      <input wire:model="task.is_completed" wire:change='taskCompleted' class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label @if ($task->is_completed) text-decoration-line-through @endif" for="flexCheckDefault">
        {{ $task->title }}
      </label>
    </div>
    <div>
      <button class="badge text-bg-secondary border-0" data-bs-toggle="modal" data-bs-target="#task-modal-{{ $task->id }}">
        <i class="bi bi-info-lg"></i>
      </button>
      @can('delete', $task)
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" class="badge text-bg-secondary border-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Удалить">
            <i class="bi bi-x-lg"></i>
          </button>
        </form>
      @endcan    
    </div>    
  </div>  

  <div class="modal fade" id="task-modal-{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $task->title }}</h1>          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                    
        </div>
        <div class="modal-body">
          @isset($task->description)
            <p>
              <span class="fw-semibold">Описание:</span>
              {{ $task->description }}
            </p>
          @endisset          
          <p>
            <span class="fw-semibold">Назначил:</span>            
            <a href="{{ route('employees.show', $task->assigner->id) }}">{{ $task->assigner->full_name }}</a>
          </p>
          <p>
            <span class="fw-semibold">Крайний срок:</span>            
            <span>{{ App\Services\DatetimeService::formatted($task->deadline) }}</span>
          </p>
          <p>
            <span class="fw-semibold">Приоритет:</span>            
            <span class="@if ($task->priority == 2) text-danger @elseif ($task->priority == 1) text-warning @endif">
              {{ $task->getPriorityName() }}
            </span>
          </p>
        </div>
        <div class="modal-footer">
          <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">
            Редактировать
          </a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>          
        </div>
      </div>
    </div>
  </div>
</div>
