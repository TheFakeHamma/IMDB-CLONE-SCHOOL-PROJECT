<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'bio',
        'photo_url',
    ];

    protected $casts = [
        'role' => 'string',
    ];

    public function contents() 
    {
        return $this->belongsToMany(Content::class, 'content_people')
                    ->withPivot('role');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($person) {
            $person->contents()->detach();
        });
    }
}

