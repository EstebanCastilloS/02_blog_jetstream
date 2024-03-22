<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Tag;
use App\Models\User;
use App\Jobs\ResizeImage;
use Illuminate\Support\Facades\Gate;
// use Intervention\Image\Facades\Image as ResizeImage;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::where('user_id',auth()->id())->latest('id')->paginate(10);
        $posts = Post::latest('id')->paginate(10);
        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.posts.create', compact('categories', 'users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        Post::create($request->all());

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Post creado correctamente',
            'text' => 'El post se creó con éxito',
        ]);

        return redirect()->route('admin.posts.index');

    }


    public function edit(Post $post)
    {
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'users', 'tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        //recuperar imagenes que ya existen
        $old_images = $post->images->pluck('path')->toArray();


        //expreciones regulares
        $re_extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';

        //extraer imagenes del contenido
        preg_match_all($re_extractImages, $request->body, $matches);
        $images = $matches[1];

        //recorrer imagenes y recuperar el patch de la imagen
        foreach ($images as $key => $image) {
            $images[$key] = "images/" . pathinfo($image, PATHINFO_BASENAME);
        }

        //imagenes que llegan del formulario y se comparan con los que ya existen
        //imagenes recientes
        $new_images = array_diff($images, $old_images);

        //eliminar imagenes que ya no se usan o las que no están asociadas al post
        $delete_images = array_diff($old_images, $images);


        //mediante la relación lo asocia con el articulo que se esta creando
        foreach($new_images as $image){
            $post->images()->create([
                'path' => $image
            ]);
        }

        //eliminar imagenes desde la base de datos
        foreach($delete_images as $image){
            Storage::delete($image);
            Image::where('path', $image)->delete();
        }


        $data = $request->all();

        //guardar de manera asyncrónica a la tabla tags
        $post->tags()->sync($request->tags);

        //manejo de imagenes
        if($request->file('image')){

            //eliminar imagen anterior
            if($post->image_path){
                Storage::delete($post->image_path);
            }
            //colocar nombre del slug y recuperando la extención de la imagen misma
            $file_name = $request->slug . '.' . $request->file('image')->getClientOriginalExtension();

            $data['image_path'] = Storage::putFileAs('posts', $request->image, $file_name);

            // Otra manera de guardar archivo con store
            // $data['image_path'] = $request->file('image')->storeAs('posts', $file_name);

            //storage/posts/imagen.jpg
            ResizeImage::dispatch($data['image_path']);

        }


        $post->update($data);

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Post actualizado correctamente',
            'text' => 'El post se actualizó con éxito',
        ]);

        return redirect()->route('admin.posts.index', $post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'type' => 'success',
            'title' => 'Post eliminado correctamente',
            'text' => 'El post se eliminó con éxito',
        ]);

        return redirect()->route('admin.posts.index');
    }
}
