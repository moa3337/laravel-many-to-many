<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
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

Route::get('/', [GuestHomeController::class, 'index']);

Route::get('/dashboard', [ProjectController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware('auth')
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {
        // # Soft-delete and trash for projects
        Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
        Route::put('/projects/{projects}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('/projects/{projects}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');

        // # Projects resource
        Route::resource('projects', ProjectController::class);
        //->parameters(['projects' => 'project:slug']);

        // # Types resource
        Route::resource('types', TypeController::class)->except(['show']);
    });

Route::middleware('auth')
    ->prefix('/profile') // tutti gli url hanno prefisso profile
    ->name('/profile') // tutti i nomi delle rotte hanno prefisso profile
    ->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

require __DIR__ . '/auth.php';
