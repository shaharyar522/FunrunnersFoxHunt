<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [indexController::class, 'index']);


// ================================================= login with Social icon =================================================


// Google Login
Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('google-login');
Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback']);

// Twitter/X Login
Route::get('/login/twitter', [SocialController::class, 'redirectToTwitter'])->name('twitter.login');
Route::get('/login/twitter/callback', [SocialController::class, 'handleTwitterCallback']);


// Facebook Login (Mock for now, until developer account is verified)
Route::get('login/facebook', [SocialController::class, 'redirectToFacebookMock'])->name('facebook-login');



// ================================================= Admin Routes =================================================


Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});
// ================================================= Admin Routes =================================================

