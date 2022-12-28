<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

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
}
