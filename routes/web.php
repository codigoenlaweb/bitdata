<?php

use App\Http\Controllers\ComentDropPanelController;
use App\Http\Controllers\ComentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* ROUTE */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/posts', PostController::class)->middleware(['auth', 'verified'])->names('posts');

Route::resource('/coments', ComentsController::class)->middleware(['auth', 'verified'])->names('coments');

Route::resource('/likes', LikeController::class)->middleware(['auth', 'verified'])->names('likes');

Route::resource('/profile', ProfileController::class)->middleware(['auth', 'verified'])->names('profile')->only('show', 'update');

Route::resource('/panel', PanelController::class)->middleware(['auth', 'verified'])->names('panel')->only('show');

Route::resource('/coment_drop_panel', ComentDropPanelController::class)->middleware(['auth', 'verified'])->names('coment_panel')->only('destroy');

require __DIR__.'/auth.php';
