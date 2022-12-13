<?php

namespace App\Http\Livewire\Deals;

use App\Models\Task as TaskModel;
use Livewire\Component;

class Task extends Component
{
    public TaskModel $task;

    protected $rules = [
        'task.is_completed' => ['required', 'boolean']
    ];

    public function mount(TaskModel $task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.deals.task');
    }

    public function taskCompleted()
    {
        $this->task->save();
    }
}
