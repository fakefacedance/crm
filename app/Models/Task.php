<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function assigner()
    {
        return $this->belongsTo(Staff::class, 'assigner_id');
    }

    public function executor()
    {
        return $this->belongsTo(Staff::class, 'executor_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }    

    public function getPriorityName()
    {
        return match ($this->priority) { 
            0 => 'Низкий', 
            1 => 'Средний', 
            2 => 'Высокий', 
        };
    }

    public function isExpired()
    {
        return now() > $this->deadline && !$this->is_completed;
    }
}
