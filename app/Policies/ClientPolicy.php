<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Staff;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;   

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Staff  $staff
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Staff $staff, Client $client)
    {
        // if $staff has a deal or task where $client appears
        $hasDeals = $client->deals->where('staff_id', $staff->id)->contains('client_id', $client->id);
        $hasTasks = $client->tasks->where('executor_id', $staff->id)->contains('client_id', $client->id);

        return $hasDeals || $hasTasks;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Staff  $staff     
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Staff $staff)
    {
        return $staff->hasRole('admin');
    }
}
