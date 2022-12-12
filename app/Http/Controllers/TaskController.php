<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Staff;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {             
        $user = Staff::find(auth()->user()->id);

        if ($user->hasPermissionTo('edit any task')) {
            $expiredTasks = Task::expired();
            $tasksToday = Task::today();
            $tasksTomorrow = Task::tomorrow();
            $defferedTasks = Task::deffered();
        } else {
            $expiredTasks = $user->expiredTasks();
            $tasksToday = $user->tasksToday();
            $tasksTomorrow = $user->tasksTomorrow();
            $defferedTasks = $user->defferedTasks();
        }        

        return view('tasks.index', [
            'expiredTasks' => $expiredTasks,
            'tasksToday' => $tasksToday,
            'tasksTomorrow' => $tasksTomorrow,
            'defferedTasks' => $defferedTasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add task');

        $user = Staff::find(auth()->user()->id);
        $deals = $user->hasPermissionTo('edit any deal') ? Deal::all() : $user->deals;

        return view('tasks.create', [
            'employees' => Staff::all(),
            'deals' => $deals,
            'clients' => Client::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigner_id' => $request->user()->id,
            'executor_id' => $request->executor ?: $request->user()->id,
            'deadline' => $request->deadline,
            'priority' => $request->priority ?: 0,
            'client_id' => $request->client,
            'deal_id' => $request->deal,
            'is_completed' => 0,
            'created_at' => now()
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
