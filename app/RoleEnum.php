<?php

namespace App;

enum RoleEnum: string
{
    case Writer = 'wrtier';
    case Admin = 'admin';
    case SuperAdmin = 'superadmin';
    case guest = 'guest';
}
