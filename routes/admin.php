<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');


//ruta de categorias
Route::resource('/categories', CategoryController::class)
    ->except('show');


//ruta de posts
Route::resource('/posts', PostController::class)
    ->except('show');

//ruta roles
Route::resource('/roles', RoleController::class)
    ->except('show');

//ruta permissions
Route::resource('/permissions', PermissionsController::class)
    ->except('show');


