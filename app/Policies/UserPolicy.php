<?php
namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
        return $user->can(PermissionEnum::viewAnyUser->value);
    }

    public function view(User $user, User $model): bool
    {
        return $user->can(PermissionEnum::viewUser->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::createUser->value);
    }

    public function update(User $user, User $model): bool
    {
        return $user->can(PermissionEnum::updateUser->value);
    }
}
