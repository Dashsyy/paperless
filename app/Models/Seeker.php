<?php

namespace App\Models;

use App\Traits\Obfuscatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seeker extends Model
{
    use HasFactory;
    use Obfuscatable;

    protected $appends = [
        'obfuscated_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function jobSeeker()
    {
        return $this->hasOne(JobSeeker::class, 'seeker_id', 'id');
    }

    public function workHistory()
    {
        return $this->hasOne(WorkHistory::class, 'seeker_id', 'id');
    }

    public function getObfuscationPrefix(): string
    {
        return 'se';
    }
}
