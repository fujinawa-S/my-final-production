<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'episode_number',
        'title',
        'release_date',
    ];
    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }
}
