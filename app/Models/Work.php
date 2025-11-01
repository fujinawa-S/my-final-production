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

class Work extends Model
{
    use HasFactory;

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
    public function genres()
    {
        return $this->hasMany(Genre::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }
}
