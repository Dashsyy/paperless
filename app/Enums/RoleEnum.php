<?php

namespace App\Enums;

enum RoleEnum: string
{
    case Editor = 'Editor';
    case Admin = 'Admin';
    case SuperAdmin = 'Superadmin';
}
