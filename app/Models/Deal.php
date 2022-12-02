<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    public $timestamps = false;

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
}
