<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'assigner_id',
        'executor_id',
        'deadline',
        'remind_at',
        'priority',
        'client_id',
        'deal_id',
        'is_completed',
        'created_at',
    ];

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

    public static function expired()
    {
        return Task::all()
                    ->filter(fn ($task) => $task->isExpired());
    }

    public static function today()
    {
        return Task::where('deadline', '>=', now())
                    ->where('deadline', '<', Carbon::tomorrow())
                    ->get();
    }

    public static function tomorrow()
    {
        return Task::where('deadline', '>=', Carbon::tomorrow())
                    ->where('deadline', '<', Carbon::tomorrow()->addDay())
                    ->get();
    }

    public static function deffered()
    {
        return Task::where('deadline', '>=', Carbon::tomorrow()->addDay())
                    ->get();
    }
}
