<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'full_name',        
        'email',
        'phone_number',        
        'created_at',
    ];
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function getCustomFields()
    {
        return DB::table('clients_custom_fields')
                    ->where('client_id', $this->id)
                    ->get();
    }
}
