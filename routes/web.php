<?php

use App\Http\Controllers\BannedController;
use App\Http\Controllers\BannedPostController;
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

Route::resource('/posts', PostController::class)->middleware(['auth', 'verified'])->names('posts')->except(['index']);

Route::resource('/coments', ComentsController::class)->middleware(['auth', 'verified'])->names('coments')->only(['store', 'update', 'destroy']);

Route::resource('/likes', LikeController::class)->middleware(['auth', 'verified'])->names('likes')->only(['store', 'destroy']);

Route::resource('/profile', ProfileController::class)->middleware(['auth', 'verified'])->names('profile')->only('show', 'update');

Route::resource('/panel', PanelController::class)->middleware(['auth', 'verified'])->names('panel')->only('show');

Route::resource('/coment_drop_panel', ComentDropPanelController::class)->middleware(['auth', 'verified'])->names('coment_panel')->only('destroy');

Route::resource('/banned', BannedController::class)->middleware(['auth', 'verified'])->names('banned')->only('update');

Route::resource('/banned_post', BannedPostController::class)->middleware(['auth', 'verified'])->names('bannedpost')->only('update');

require __DIR__.'/auth.php';
