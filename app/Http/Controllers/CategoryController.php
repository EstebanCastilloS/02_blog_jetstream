<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(10);
        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());

        session()->flash(
            'swal', [
                'icon' => 'success',
                'title' => 'Buen Trabajo',
                'text' => 'La categoría se creó correctamente',
        ]);

        return redirect()->route('admin.categories.index');

    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // $category->name = $request->name;
        // $category->update();

        $category->update($request->all());

        session()->flash(
            'swal', [
                'icon' => 'success',
                'title' => 'Bien Hecho',
                'text' => 'La categoría se actualizó correctamente',
            ]);

        return redirect()->route('admin.categories.index', $category);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->delete();

        session()->flash(
            'swal', [
                'icon' => 'success',
                'title' => 'Bien Hecho',
                'text' => 'La categoría se eliminó correctamente',
            ]);

        return redirect()->route('admin.categories.index');
    }


}
