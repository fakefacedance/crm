<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class DatetimeService
{
    public static function formatted($datetime, $format = 'D MMM YYYY HH:mm')
    {
        return Carbon::create($datetime)->isoFormat($format);
    }
}
