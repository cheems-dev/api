<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    const PUBLISHED = 1;
    const MODERATION = 2;

    // Relacion Inversa \ uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relacion muchos a muchos

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Relacion uno a muchos polimorfica
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
