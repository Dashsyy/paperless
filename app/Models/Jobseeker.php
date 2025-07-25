<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jobseeker extends Model
{
    use HasFactory;

    public function seeker(): BelongsTo
    {
        return $this->belongsTo(Seeker::class);
    }
}
