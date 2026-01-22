<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VotingController;

// =========================================================

Route::get('/project', function () {
    return view('backup-page.project-flow');
});

// =============================================================

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
    Route::get('login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Route::middleware(['admin'])->group(function () {
       
        
    //     // Voting Routes
    //     // Route::get('voting', [AdminController::class, 'votingList'])->name('admin.voting.list');
    //     Route::get('voting/{id}', [AdminController::class, 'votingDetail'])->name('admin.voting.detail');
    //     Route::post('voting/update-contestant-status/{id}', [AdminController::class, 'updateContestantStatus'])->name('admin.voting.update-status');
        
    //     // Member & Contestant Routes
    //     Route::get('members', [AdminController::class, 'membersList'])->name('admin.members.list');
    //     Route::get('contestants', [AdminController::class, 'contestantsList'])->name('admin.contestants.list');
    // });
});
// ================================================= Admin Routes =================================================




// ================================================= Voting Routes =================================================


Route::prefix('admin')->middleware('auth')->group(function () {

     Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/voting', [VotingController::class, 'index'])
        ->name('admin.voting.list');

        Route::post('/voting/status/{id}', [VotingController::class, 'changeStatus'])
    ->name('admin.voting.status');


    // create voting
    Route::get('/voting/create', [VotingController::class, 'create'])->name('admin.voting.create');
    Route::post('/voting/store', [VotingController::class, 'store'])->name('admin.voting.store');

    //details route
    Route::get('/voting/detail/{id}', [VotingController::class, 'detail'])->name('admin.voting.detail');
    
    // Toggle contestant status inside voting (AJAX optional)
Route::post('/voting-contestant/toggle/{id}', [VotingController::class, 'toggleContestantStatus'])->name('admin.votingContestant.toggle');

});