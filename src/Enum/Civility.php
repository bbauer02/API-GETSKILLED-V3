<?php

namespace App\Enum;

enum Civility : string
{
    case MR = 'Mr';
    case MRS = 'Mrs';
    case MISS = 'Miss';
    case OTHER = 'Other';
}