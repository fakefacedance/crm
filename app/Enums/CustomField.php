<?php

namespace App\Enums;

enum CustomField: string
{
    case STRING = 'string';
    case NUMBER = 'number';
    case DATE = 'date';
    case DATETIME = 'datetime';
}