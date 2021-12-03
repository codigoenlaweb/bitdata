<?php

use App\Http\Controllers\ComentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfessionController;
use Illuminate\Support\Facades\Route;

/* ROUTE */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/posts', PostController::class)->middleware(['auth', 'verified'])->names('posts');

Route::resource('/coments', ComentsController::class)->middleware(['auth', 'verified'])->names('coments');

require __DIR__.'/auth.php';
