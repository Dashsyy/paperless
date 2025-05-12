<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seeker extends Model
{
    use HasFactory;

    public function jobSeeker()
    {
        return $this->hasOne(JobSeeker::class, 'seeker_id', 'id');
    }

    public function workHistory()
    {
        return $this->hasOne(WorkHistory::class, 'seeker_id', 'id');
    }
}
