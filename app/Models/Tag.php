<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    //relacion mucho a muchos polimorfica Inversa con post
    public function posts(){
        return $this->morphedByMany(Post::class, 'taggable');
    }

}
