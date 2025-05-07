<?php

namespace App\Console\Commands;

use App\Models\Jobseeker;
use App\Models\SeekerRole;
use Illuminate\Console\Command;

class SyncaRoleFromJobSeeker extends Command
{
    protected $signature = 'app:synca-roles';

    protected $description = 'Command description';

    public function handle()
    {
        $roles = Jobseeker::query()->pluck('role')->toArray();

        foreach ($roles as $role) {
            SeekerRole::query()->create([
                'name' => $role
            ]);
        }

    }
}
