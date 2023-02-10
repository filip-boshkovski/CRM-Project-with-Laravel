<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/clients/{id}/restore', [ClientsController::class, 'restore'])->name('clients.restore');
    Route::post('/clients/{id}/force_delete', [ClientsController::class, 'forceDelete'])->name('clients.force_delete');
    Route::resource('/clients', ClientsController::class)->except('show');

    Route::post('/projects/{id}/restore', [ProjectsController::class, 'restore'])->name('projects.restore');
    Route::post('/projects/{id}/force_delete', [ProjectsController::class, 'forceDelete'])->name('projects.force_delete');
    Route::resource('/projects', ProjectsController::class)->except('show');

    Route::post('/tasks/{id}/restore', [TasksController::class, 'restore'])->name('tasks.restore');
    Route::post('/tasks/{id}/force_delete', [TasksController::class, 'forceDelete'])->name('tasks.force_delete');
    Route::resource('/tasks', TasksController::class)->except('show');

    Route::post('/users/{id}/restore', [UsersController::class, 'restore'])->name('users.restore');
    Route::post('/users/{id}/force_delete', [UsersController::class, 'forceDelete'])->name('users.force_delete');
    Route::resource('/users', UsersController::class)->except('show');
});

require __DIR__ . '/auth.php';
