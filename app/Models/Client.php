<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
