<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//-- Rutas de autenticación que proporciona Laravel UI login, register, logout, etc.
Auth::routes();

//-- Todos los usuarios autenticados pueden ver listado y detalle
Route::middleware(['auth'])->group(function () {

    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index')
        ->middleware('role:admin|editor|user');

    Route::get('/tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show')
        ->middleware('role:admin|editor|user');

    //-- Solo admin y editor pueden crear/editar/borrar
    Route::middleware(['role:admin|editor'])->group(function () {

        Route::get('/tasks/create', [TaskController::class, 'create'])
            ->name('tasks.create');

        Route::post('/tasks', [TaskController::class, 'store'])
            ->name('tasks.store');

        Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
            ->name('tasks.edit');

        Route::put('/tasks/{task}', [TaskController::class, 'update'])
            ->name('tasks.update');

        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
            ->name('tasks.destroy');
    });

    //-- Solo admin puede ver listado de usuarios
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');
    });
});