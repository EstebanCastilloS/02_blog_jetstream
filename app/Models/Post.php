<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

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

    protected function title(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucfirst($value)
        );
    }

    protected function image(): Attribute
    {
        return new Attribute(
            // get: fn() => $this->image_path ?? 'https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg'

            get: function() {
                if($this->image_path){

                    if(substr($this->image_path, 0, 8) === 'https://'){
                        // dd($this->image_path);
                        return $this->image_path;
                    }

                    // dd(Storage::url($this->image_path));
                    return Storage::url($this->image_path);
                }else{
                    return 'https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg';
                }
            }

        );
    }

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

    //relacion uno a muchos polimorfica con images
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }


}




