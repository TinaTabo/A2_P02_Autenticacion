<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//-- Rutas de autenticación que proporciona Laravel UI login, register, logout, etc.
Auth::routes();

Route::get('/home', function(){
    return redirect()->route('posts.index');
})->name('home');

Route::middleware('auth','role:admin')->group(function () {
    Route::resource('posts', App\Http\Controllers\PostController::class);
});

//-- Ejemplo de uso de middleware de permisos en una ruta concreta
// Route::get('posts/create', [PostController::class, 'create'])
// ->middleware(['auth', 'permission:create posts']);

// Test de CRUD posts
// Route::get('/', function(){
//     return redirect()->route('posts.index');
// });

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
