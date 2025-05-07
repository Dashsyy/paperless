<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case viewAnyUser = 'user:any.view';
    case viewUser = 'user.view';
    case createUser = 'user.create';
    case updateUser = 'user.update';
}
