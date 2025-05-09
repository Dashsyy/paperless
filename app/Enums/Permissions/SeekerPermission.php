<?php

namespace App\Enums\Permissions;

enum SeekerPermission: string
{
    case viewAnySeeker = 'seeker:any.view';
    case viewSeeker = 'seeker.view';
    case createSeeker = 'seeker.create';
    case updateSeeker = 'seeker.update';
    case deleteSeeker = 'seeker.delete';
}