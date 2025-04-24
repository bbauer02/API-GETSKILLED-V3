<?php

namespace App\Enum;

enum Gender : string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case UNKNOWN = 'unknown';
    case OTHER = 'other';

}