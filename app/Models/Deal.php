<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'client_id',
        'staff_id',
        'funnel_id',
        'stage',
        'amount',
        'created_at',
        'closed_at'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getStage()
    {
        return $this->funnel->stages[$this->stage];
    }
}
