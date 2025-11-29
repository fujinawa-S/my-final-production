<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Episode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'work_id',
        'title',
        'summary',
        'anime_episode_count',
        'manga_volume_count',
        'media_type',
    ];

    protected $casts = [
        'anime_episode_count' => 'integer',
        'manga_volume_count' => 'integer',
    ];

    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }

    public function favoredByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'episode_favorites')
            ->withTimestamps();
    }
}
