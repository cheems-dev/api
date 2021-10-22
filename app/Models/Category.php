<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];
    protected $allowIncluded = ['posts', 'posts.user'];

    // Relaccion uno a muchos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included')))
            return;
        $relations = explode(',', request('included')); //['posts', 'relations2']
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship))
                unset($relations[$key]);
        }

        $query->with($relations);
    }
}
