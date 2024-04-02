<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['can:Acceso al Dashboard'])
->name('dashboard');


//ruta de categorias
Route::resource('/categories', CategoryController::class)
    ->except('show')
    ->middleware(['can:Gestión de Categorías']);

//ruta de posts
Route::resource('/posts', PostController::class)
    ->except('show')
    ->middleware(['can:Gestión de Artículos']);

//ruta roles
Route::resource('/roles', RoleController::class)
    ->except('show')
    ->middleware(['can:Gestión de Roles']);


//ruta permissions
Route::resource('/permissions', PermissionsController::class)
    ->except('show')
    ->middleware(['can:Gestión de Permisos']);;

//ruta de usuarios
Route::resource('/users', UserController::class)
    ->except('show', 'create', 'store');


