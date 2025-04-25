<?php

namespace App\Enum;

enum GenderEnum : string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case UNKNOWN = 'unknown';
    case OTHER = 'other';

}