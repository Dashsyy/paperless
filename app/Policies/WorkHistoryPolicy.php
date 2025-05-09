<?php

namespace App\Policies;

use App\Enums\Permissions\WorkHistoryPermission;
use App\Models\User;
use App\Models\WorkHistory;

class WorkHistoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(WorkHistoryPermission::viewAnyWorkHistory);
    }

    public function view(User $user, WorkHistory $workHistory): bool
    {
        return $user->can(WorkHistoryPermission::viewWorkHistory);
    }

    public function create(User $user): bool
    {
        return $user->can(WorkHistoryPermission::createWorkHistory);
    }

    public function update(User $user, WorkHistory $workHistory): bool
    {
        return $user->can(WorkHistoryPermission::updateWorkHistory);
    }
}
