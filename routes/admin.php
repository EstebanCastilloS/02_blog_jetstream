<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Bienvenido al panel de administración";
});


// Route::get('/', function () {
//     return view('admin.dashboard');
// })->middleware(['can:Acceso al Dashboard'])
// ->name('admin.dashboard');
