<?php

namespace App\Enums\Permissions;

enum UserPermission: string
{
    case viewAnyUser = 'user:any.view';
    case viewUser = 'user.view';
    case createUser = 'user.create';
    case updateUser = 'user.update';
    case deleteUser = 'user.delete';
}
