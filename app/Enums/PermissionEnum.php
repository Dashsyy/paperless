<?php
namespace App\Enums;

enum PermissionEnum: String {

    case viewAnyUser = 'user:any.view';
    case viewUser    = 'user.view';
    case createUser  = 'user.create';
    case updateUser  = 'user.update';

    case viewAnyPost = 'post:any.view';
}
