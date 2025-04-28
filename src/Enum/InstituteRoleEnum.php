<?php

namespace App\Enum;

enum InstituteRoleEnum : string
{
    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case STAFF = 'staff';
}