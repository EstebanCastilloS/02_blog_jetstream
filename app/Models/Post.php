<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //proteccion de campos
    public $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = True;

    protected $fillable =
    [
        'title',
        'slug',
        'excerpt',
        'body',
        'image_path',
        'published',
        'category_id',
        'user_id',
        'published_at',

    ];

    protected $guarded = ['id'];


    //relacion uno a muchos inversa con usuarios
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion uno a uno inversa con categorias
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relacion muchos a muchos  polimorfica con tags
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }

    //relacion uno a muchos polimorfica con comments
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

}




