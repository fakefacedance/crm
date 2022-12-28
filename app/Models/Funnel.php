<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function stages()
    {
        return $this->hasMany(FunnelStage::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
