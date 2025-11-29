<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Work extends Model
{
    use HasFactory;

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function favoredByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'work_favorites')
            ->withTimestamps();
    }
}
