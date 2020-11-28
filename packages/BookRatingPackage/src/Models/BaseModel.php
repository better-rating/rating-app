<?php

namespace BetterRating\BookRatingPackage\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;
use App\Models\Link;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class BaseModel extends Model
{
    use HasSlug;

    protected $guarded = ['id'];

    //=== RELATIONSHIPS ===//
    public function rating()
    {
        return $this->morphOne(Rating::class, 'media');
    }

    public function links()
    {
        return $this->morphMany(Link::class, 'media');
    }

    //=== METHODS ===//
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public static function retrieve($value)
    {
        return self::where('slug', $value)->firstOrFail();
    }
}
