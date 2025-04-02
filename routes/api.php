<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');;
Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
Route::get('/posts/{post}/comments', [CommentController::class, 'show']);
Route::get('/comments', [CommentController::class, 'index']);
Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'delete']);

