<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Staff $staff)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Staff  $staff
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Staff $staff, Task $task)
    {
        return $task->assigner->is($staff);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Staff  $staff
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Staff $staff, Task $task)
    {
        return $task->assigner->is($staff);
    }
}
