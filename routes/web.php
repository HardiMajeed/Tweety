<?php

use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\TweetController;

use App\Http\Controllers\TweetLikesController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ExploreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/tweets', [TweetController::class, 'index'])->name('home');
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweet.store');

    Route::post('/tweets/{tweet}/like', [TweetLikesController::class, 'store']);
    Route::delete('/tweets/{tweet}/like', [TweetLikesController::class, 'destroy']);

    Route::post('/profiles/{user:username}/follow', [FollowsController::class, 'store'])->name('follow');
    Route::get('/profiles/{user:username}/edit', [ProfilesController::class, 'edit'])->middleware('can:edit,user');
    Route::patch('/profiles/{user:username}', [ProfilesController::class, 'update'])->middleware('can:edit,user');
    Route::get('/explore', ExploreController::class);
});

Route::get('/profiles/{user:username}', [ProfilesController::class, 'show'])->name('profile');

require __DIR__ . '/auth.php';
