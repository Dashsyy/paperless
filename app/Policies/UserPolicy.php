<?php

namespace App\Policies;

use App\Enums\Permissions\UserPermission;
use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(UserPermission::viewAnyUser->value);
    }

    public function view(User $user, User $model): bool
    {
        return $user->can(UserPermission::viewUser->value);
    }

    public function create(User $user): bool
    {
        return $user->can(UserPermission::createUser->value);
    }

    public function update(User $user, User $model): bool
    {
        return $user->can(UserPermission::updateUser->value);
    }
}
