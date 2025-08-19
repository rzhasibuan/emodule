<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuleController;

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

Route::get('/', [\App\Http\Controllers\WelcomeController::class, "index"])->name('welcome');

Route::get('/login',[LoginController::class, 'index'])->name('login');

Route::post('/login',[LoginController::class, 'login_process'])->name('login_process');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/delete/{id_users}', [AdminController::class, 'delete'])->name('delete');
    Route::get('/show/{id_users}', [AdminController::class, 'show_user'])->name('show_user');
    Route::post('/update/{id_users}', [AdminController::class, 'change_user'])->name('change_user');

    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('modules.show');
    Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');
});

Route::view('/how-to-use', 'how-to-use')->name('how-to-use');
