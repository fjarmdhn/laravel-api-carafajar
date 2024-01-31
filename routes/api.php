<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Author\PostController as AuthorPostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{post:id}', [PostController::class, 'show']);
        Route::post('/posts', [PostController::class, 'store']);
        Route::put('/posts/{post:id}', [PostController::class, 'update']);
        Route::delete('/posts/{post:id}', [PostController::class, 'destroy']);
    });

Route::prefix('author')
    ->middleware(['auth:sanctum', 'role:author'])
    ->group(function () {
        Route::get('/posts', [AuthorPostController::class, 'index']);
        Route::get('/posts/{post:id}', [AuthorPostController::class, 'show']);
        Route::post('/posts', [AuthorPostController::class, 'store']);
    });


Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);
Route::middleware(['auth:sanctum', 'role:admin|author'])->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
});
