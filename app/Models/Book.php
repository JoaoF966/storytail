<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;


    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)->using(AuthorBook::class);
    }

    public function bookUserReads(): HasMany
    {
        return $this->hasMany(BookUserRead::class);
    }

    private float $averageRating = 0;

    public function averageRating()
    {
        if (0.0 !== $this->averageRating) {
            return $this->averageRating;
        }

        $ratings = $this->bookUserReads->pluck('rating');

        if ($ratings->isEmpty()) {
            return 0.0;
        }
        $this->averageRating = round($ratings->avg(), 1);

        return $this->averageRating;
    }
}
