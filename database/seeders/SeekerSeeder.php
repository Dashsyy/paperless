<?php

namespace Database\Seeders;

use App\Models\Seeker;
use Illuminate\Database\Seeder;

class SeekerSeeder extends Seeder
{
    public function run(): void
    {
        Seeker::factory()->count(20)->create();
    }
}
