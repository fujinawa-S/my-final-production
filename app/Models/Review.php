<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Work;
use App\Models\Comment;
use App\Models\ReviewPhoto;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_id',
        'title',
        'body',
        'score',
        'is_spoiler',
        'is_published',
    ];

    protected $casts = [
        'score' => 'integer',
        'is_spoiler' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ReviewPhoto::class);
    }

    public function favoredBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'review_favorites')
            ->withTimestamps();
    }
}
