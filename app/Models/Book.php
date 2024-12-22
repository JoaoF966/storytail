<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function ageGroup(): HasOne
    {
        return $this->hasOne(AgeGroup::class, 'id', 'age_group_id');
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

    public function isFeatured(): bool
    {
        if ($this->featured_at === null) {
            return false;
        }

        try {
            $featuredAt = new DateTime($this->featured_at);

            return $featuredAt->format('Ym') === (new DateTime())->format('Ym');

        } catch (\Exception $e) {
            return false;
        }
    }
}
