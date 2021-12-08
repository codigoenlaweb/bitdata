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
use App\Http\Controllers\UserBannedController;
use Illuminate\Support\Facades\Route;

/* ROUTE */

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'checkbanned'])->name('dashboard');

Route::get('/user_banned', [UserBannedController::class, 'index'])->middleware(['auth', 'verified', 'checknobanned'])->name('user_banned');

Route::resource('/posts', PostController::class)->middleware(['auth', 'verified', 'checkbanned'])->names('posts')->except(['index']);

Route::resource('/coments', ComentsController::class)->middleware(['auth', 'verified', 'checkbanned'])->names('coments')->only(['store', 'update', 'destroy']);

Route::resource('/likes', LikeController::class)->middleware(['auth', 'verified', 'checkbanned'])->names('likes')->only(['store', 'destroy']);

Route::resource('/profile', ProfileController::class)->middleware(['auth', 'verified', 'checkbanned'])->names('profile')->only('show', 'update');

Route::resource('/panel', PanelController::class)->middleware(['auth', 'verified', 'checkbanned'])->names('panel')->only('show');

Route::resource('/coment_drop_panel', ComentDropPanelController::class)->middleware(['auth', 'verified', 'checkbanned'])->names('coment_panel')->only('destroy');

Route::resource('/banned', BannedController::class)->middleware(['auth', 'verified', 'checkbanned', 'onlyadmin'])->names('banned')->only('update');

Route::resource('/banned_post', BannedPostController::class)->middleware(['auth', 'verified', 'onlyadmin'])->names('bannedpost')->only('update');

require __DIR__.'/auth.php';
