<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('posts', App\Http\Controllers\PostController::class);
Route::get('/', function(){
    return redirect()->route('posts.index');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
