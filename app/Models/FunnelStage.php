<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelStage extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }
}
