<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user', [UserController::class, 'index']);
});

Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/{task}/complete', [App\Http\Controllers\TaskController::class, 'complete'])->name('tasks.complete');
Route::get('/taskshow', [App\Http\Controllers\TaskController::class, 'showCompleted'])->name('tasks.show'); 


Route::get('/user/view', [UserController::class, 'index'])->name('users.index');
Route::get('/user/show/{userId}', [UserController::class, 'showUser'])->name('users.show');
Route::get('/user/edit/{userId}', [UserController::class, 'editUser'])->name('users.edit');
Route::put('/user/update/{userId}', [UserController::class, 'updateUser'])->name('users.update');
Route::delete('/user/{userId}', [UserController::class, 'deleteUser'])->name('users.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
