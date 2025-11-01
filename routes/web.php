<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts', [ReviewController::class, 'index']);
Route::get('/posts/{post}', [ReviewController::class, 'show']);
Route::post('/reviews', [ReviewController::class, 'store'])->middleware(['auth'])->name('reviews.store');
Route::get('works/{workId}', [WorkController::class, 'show'])->name('works.show');
Route::post('/comments', [CommentController::class, 'store'])->middleware(['auth'])->name('comments.store');
