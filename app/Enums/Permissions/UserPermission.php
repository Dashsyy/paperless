<?php

namespace App\Enums\Permissions;

enum UserPermission: string
{
    case viewAnyUser = 'user:any.view';
    case VIEW = 'user.view';
    case CREATE = 'user.create';
    case UPDATE = 'user.update';
    case DELETE = 'user.delete';
}
