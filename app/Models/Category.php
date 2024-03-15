<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //proteccion de campos
    public $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = True;

    //asignacion masiva
    protected $fillable =
    [
        'name',

    ];
    protected $guarded = ['id'];



    //relacion uno a muchos con post
    public function posts(){
        return $this->hasMany(Post::class);
    }

}
