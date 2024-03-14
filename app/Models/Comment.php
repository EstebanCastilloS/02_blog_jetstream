<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //relacion uno a muchos inversa con usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion polimorfica con posts uno a muchos
    public function commentable()
    {
        return $this->morphTo();
    }

    //relacion uno a muchos polimorfica con images
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

}
