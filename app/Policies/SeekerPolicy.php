<?php

namespace App\Policies;

use App\Enums\Permissions\SeekerPermission;
use App\Models\Seeker;
use App\Models\User;

class SeekerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(SeekerPermission::viewAnySeeker);
    }

    public function view(User $user, Seeker $seeker): bool
    {
        return $user->can(SeekerPermission::viewSeeker);
    }

    public function create(User $user): bool
    {
        return $user->can(SeekerPermission::createSeeker);
    }

    public function update(User $user, Seeker $seeker): bool
    {
        return $user->can(SeekerPermission::updateSeeker);
    }
}
