<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\User;

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
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
