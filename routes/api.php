<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('blogs', BlogController::class);

Route::resource('comments', CommentController::class);

Route::resource('products', ProductController::class);

Route::resource('projects', ProjectController::class);

Route::resource('contacts', ContactController::class);

Route::resource('settings', SettingsController::class);
