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
    return view('reviews.index');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::delete('/reviews/{id}', [ReviewController::class, 'delete'])->name('reviews.delete');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
