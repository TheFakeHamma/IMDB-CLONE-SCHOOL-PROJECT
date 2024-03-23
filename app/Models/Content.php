<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'release_date',
        'synopsis',
        'type',
        'photo_url',
        'trailer_url',
    ];

    protected $casts = [
        'release_date' => 'datetime',
    ];
    

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'content_genre', 'content_id', 'genre_id');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'content_people')
                    ->withPivot('role');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function watchlistedBy()
    {
        return $this->hasMany(Watchlist::class);
    }

    protected $appends = ['averageRating'];

    public function getAverageRatingAttribute()
    {
        $ratings = $this->reviews->pluck('rating');
        return $ratings->isNotEmpty() ? round($ratings->avg(), 2) : 'No reviews';
    }


}
