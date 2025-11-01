<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Genre extends Model
{
    use HasFactory;

    /**
     * このジャンルに属するすべての作品
     */
    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }
}
