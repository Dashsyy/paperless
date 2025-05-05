<?php

namespace App\Enums;

enum RoleEnum: string
{
    case Editor = 'editor';
    case Admin = 'admin';
    case SuperAdmin = 'superadmin';
}
