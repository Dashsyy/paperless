<?php

namespace Database\Seeders;

use App\Models\Seeker;
use App\Models\WorkHistory;
use Illuminate\Database\Seeder;

class WorkHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seeker::query()->get()->pluck('id')->each(function ($seekerId) {
            WorkHistory::factory()->count(3)->create([
                'seeker_id' => $seekerId,
            ]);
        });
    }
}
