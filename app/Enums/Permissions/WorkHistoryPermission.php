<?php

namespace App\Enums\Permissions;

enum WorkHistoryPermission: string
{
    case viewAnyWorkHistory = 'work-history:any.view';
    case viewWorkHistory = 'work-history.view';
    case createWorkHistory = 'work-history.create';
    case updateWorkHistory = 'work-history.update';
    case deleteWorkHistory = 'work-history.delete';
}