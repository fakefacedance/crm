<?php

namespace App\Services;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Employee;
use App\Models\Task;

class TaskService
{
    public static function indexViewData()
    {
        $canViewTask = function ($task) {
            return auth()->user()->can('view', $task);
        };
        
        return [
            'expiredTasks' => Task::expired()->filter($canViewTask),
            'tasksToday' => Task::today()->filter($canViewTask)->where('is_completed', false),
            'tasksTomorrow' => Task::tomorrow()->filter($canViewTask)->where('is_completed', false),
            'defferedTasks' => Task::deffered()->filter($canViewTask)->where('is_completed', false),
        ];
    }

    public static function createViewData()
    {
        $user = Employee::find(auth()->user()->id);
        $deals = $user->hasPermissionTo('edit any deal') ? Deal::all() : $user->deals;
        
        return [
            'employees' => Employee::all(),
            'deals' => $deals,
            'clients' => Client::all()
        ];
    }

    public static function createTask(CreateTaskRequest $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigner_id' => $request->user()->id,
            'executor_id' => $request->executor ?: $request->user()->id,
            'deadline' => $request->deadline,
            'remind_at' => $request->remind_at,
            'priority' => $request->priority ?: 0,
            'client_id' => $request->client,
            'deal_id' => $request->deal,
            'is_completed' => 0,
            'created_at' => now()
        ]);
    }

    public static function editViewData($taskId)
    {
        $user = Employee::find(auth()->user()->id);
        $deals = $user->hasPermissionTo('edit any deal') ? Deal::all() : $user->deals;
        
        return  [
            'task' => Task::find($taskId),
            'employees' => Employee::all(),
            'deals' => $deals,
            'clients' => Client::all()
        ];
    }

    public static function updateTask(UpdateTaskRequest $request, $taskId)
    {
        Task::where('id', $taskId)->update([
            'title' => $request->title,
            'description' => $request->description,            
            'executor_id' => $request->executor ?: $request->user()->id,
            'deadline' => $request->deadline,
            'remind_at' => $request->remind_at,
            'priority' => $request->priority ?: 0,
            'client_id' => $request->client,
            'deal_id' => $request->deal,
        ]);
    }
}