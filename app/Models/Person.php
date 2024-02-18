<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $primaryKey = 'person_id';

    protected $fillable = [
        'name',
        'bio',
        'photo_url',
    ];

    public function contents() 
    {
        return $this->belongsToMany(Content::class, 'content_people')
                    ->withPivot('role');
    }
}
