<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;   

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Employee $employee, Client $client)
    {
        // if $employee has a deal or task where $client appears
        $hasDeals = $client->deals->where('employee_id', $employee->id)->contains('client_id', $client->id);
        $hasTasks = $client->tasks->where('executor_id', $employee->id)->contains('client_id', $client->id);

        return $hasDeals || $hasTasks;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Employee  $employee     
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Employee $employee)
    {
        return $employee->hasRole('admin');
    }
}
