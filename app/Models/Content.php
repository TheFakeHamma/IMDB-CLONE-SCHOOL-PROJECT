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

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'content_genre', 'content_id', 'genre_id');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'content_people')
                ->withPivot('role');
    }
}
