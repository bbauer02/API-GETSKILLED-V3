<?php

namespace App\Enum;

enum InstitutRoleEnum : string
{
    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case STAFF = 'staff';
}