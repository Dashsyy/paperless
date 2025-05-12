<?php

namespace App\Policies;

use App\Enums\Permissions\JobseekerPermission;
use App\Models\jobseeker;
use App\Models\User;
use Illuminate\Contracts\Queue\Job;

class JobseekerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can(JobseekerPermission::viewAnyJobseeker);
    }

    public function view(User $user, jobseeker $jobseeker): bool
    {
        return $user->can(JobseekerPermission::viewJobseeker->value);
    }

    public function create(User $user): bool
    {
        return $user->can(JobseekerPermission::createJobseeker);
    }

    public function update(User $user, jobseeker $jobseeker): bool
    {
        return $user->can(JobseekerPermission::updateJobseeker);
    }
}
