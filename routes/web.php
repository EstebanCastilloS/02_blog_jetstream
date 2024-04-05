<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostDetailController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomeController::class)->name('home');

//se crea para mostrar el detalle de un post
Route::get('posts/{post}',[PostDetailController::class, 'show'])->name('posts.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::post('images/upload',[ImageController::class, 'upload'])->name('images.upload');
