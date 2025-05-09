<?php

namespace App\Enums\Permissions;

enum JobseekerPermission: string
{
    case viewAnyJobseeker = 'jobseeker:any.view';
    case viewJobseeker = 'jobseeker.view';
    case createJobseeker = 'jobseeker.create';
    case updateJobseeker = 'jobseeker.update';
    case deleteJobseeker = 'jobseeker.delete';
}
