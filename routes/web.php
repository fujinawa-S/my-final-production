<?php

use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\EpisodeFavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewFavoriteController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorkFavoriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'delete'])->name('reviews.delete');

Route::get('/works', [WorkController::class, 'index'])->name('works.index');
Route::get('/works/{work}', [WorkController::class, 'show'])->name('works.show');

Route::get('/episodes', [EpisodeController::class, 'index'])->name('episodes.index');

Route::middleware('auth')->group(function () {
    Route::post('/reviews/{review}/comments', [CommentController::class, 'store'])->name('reviews.comments.store');
    Route::delete('/reviews/{review}/comments/{comment}', [CommentController::class, 'delete'])->name('reviews.comments.destroy');

    Route::get('/episodes/create', [EpisodeController::class, 'create'])->name('episodes.create');
    Route::post('/episodes', [EpisodeController::class, 'store'])->name('episodes.store');
    Route::get('/episodes/{episode}', [EpisodeController::class, 'show'])->name('episodes.show');
    Route::get('/episodes/{episode}/edit', [EpisodeController::class, 'edit'])->name('episodes.edit');
    Route::put('/episodes/{episode}', [EpisodeController::class, 'update'])->name('episodes.update');
    Route::delete('/episodes/{episode}', [EpisodeController::class, 'destroy'])->name('episodes.destroy');

    Route::post('/reviews/{review}/favorite', [ReviewFavoriteController::class, 'store'])->name('reviews.favorite.store');
    Route::delete('/reviews/{review}/favorite', [ReviewFavoriteController::class, 'delete'])->name('reviews.favorite.delete');

    Route::post('/works/{work}/favorite', [WorkFavoriteController::class, 'store'])->name('works.favorite.store');
    Route::delete('/works/{work}/favorite', [WorkFavoriteController::class, 'destroy'])->name('works.favorite.destroy');

    Route::post('/episodes/{episode}/favorite', [EpisodeFavoriteController::class, 'store'])->name('episodes.favorite.store');
    Route::delete('/episodes/{episode}/favorite', [EpisodeFavoriteController::class, 'destroy'])->name('episodes.favorite.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/verify-email', EmailVerificationPromptController::class)
    ->middleware('auth')
    ->name('verification.notice');

require __DIR__ . '/auth.php';
