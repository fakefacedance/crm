<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Authenticatable
{
    use HasFactory, HasRoles;
    
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'position',
        'email',
        'phone_number',
        'password',
        'created_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',        
    ];

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    // returns tasks that an employee assigned
    public function tasksAssignedBy()
    {
        return $this->hasMany(Task::class, 'assigner_id');
    }

    // returns tasks assigned to an employee
    public function tasksAssignedTo()
    {
        return $this->hasMany(Task::class, 'executor_id');
    }

    public function expiredTasks()
    {
        return $this->tasksAssignedTo->filter(function ($task, $key) {
            return $task->isExpired();
        });
    }

    public function tasksToday()
    {
        return $this->tasksAssignedTo->toQuery()
            ->where('deadline', '>=', today())
            ->where('deadline', '<', Carbon::tomorrow())
            ->get();
    }

    public function tasksTomorrow()
    {
        return $this->tasksAssignedTo->toQuery()
            ->where('deadline', '>=', Carbon::tomorrow())
            ->where('deadline', '<', Carbon::tomorrow()->addDay())
            ->get();
    }

    public function defferedTasks()
    {
        return $this->tasksAssignedTo->toQuery()
            ->where('deadline', '>=', Carbon::tomorrow()->addDay())
            ->get();
    }
}
