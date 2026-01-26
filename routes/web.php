<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VotingController;
use App\Http\Controllers\Contestant\ContestantController;
use App\Http\Controllers\Member\MemberController;

// =========================================================

Route::get('/project', function () {

    return view('backup-page.project-flow');

});

// =======================================================================

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



// ================================================= Dashboards =================================================

// Contestant Dashboard (requires payment)
Route::middleware(['auth', 'unpaid_contestant'])->group(function () {
    Route::get('/contestant-dashboard', [App\Http\Controllers\Contestant\ContestantController::class, 'dashboard'])->name('contestant.dashboard');
});

// Member Dashboard (requires subscription)
Route::middleware(['auth', 'unpaid_member'])->group(function () {
    Route::get('/member-dashboard', [App\Http\Controllers\Member\MemberController::class, 'dashboard'])->name('member.dashboard');
});

// Contestant Onboarding Routes
Route::middleware('auth')->prefix('onboarding')->group(function () {

    Route::get('/', [App\Http\Controllers\Contestant\ContestantOnboardingController::class, 'index'])->name('contestant.onboarding.index');
    Route::post('/pay', [App\Http\Controllers\Contestant\ContestantOnboardingController::class, 'processPayment'])->name('contestant.onboarding.pay');
    Route::get('/success', [App\Http\Controllers\Contestant\ContestantOnboardingController::class, 'paymentSuccess'])->name('contestant.onboarding.success');
    Route::get('/profile', [App\Http\Controllers\Contestant\ContestantOnboardingController::class, 'showProfileForm'])->name('contestant.profile.create');
    Route::post('/profile', [App\Http\Controllers\Contestant\ContestantOnboardingController::class, 'storeProfile'])->name('contestant.profile.store');
    
});

// Member Onboarding Routes
Route::middleware('auth')->prefix('member/onboarding')->group(function () {

    Route::get('/', [App\Http\Controllers\Member\MemberOnboardingController::class, 'index'])->name('member.onboarding.index');
    Route::post('/pay', [App\Http\Controllers\Member\MemberOnboardingController::class, 'processPayment'])->name('member.onboarding.pay');
    Route::get('/success', [App\Http\Controllers\Member\MemberOnboardingController::class, 'paymentSuccess'])->name('member.onboarding.success');
    
});


// ================================================================================= Admin Routes =================================================================================


Route::prefix('admin')->group(function () {

    Route::get('login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function () {

        // Member & Contestant Routes
        Route::get('members', [AdminController::class, 'membersList'])->name('admin.members.list');
        Route::get('contestants', [AdminController::class, 'contestantsList'])->name('admin.contestants.list');
        Route::post('contestants/{id}/toggle-status', [AdminController::class, 'toggleContestantStatus'])->name('admin.contestants.toggle');

        // contestant and member dashboard show when click on dasboard buttun sidebar  right now..
        Route::get('/contestant-dashboard', [ContestantController::class, 'dashboard'])->name('contestant.dashboard');
        Route::get('/member-dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
       

    });

});


// ================================================================================= Admin Routes =================================================================================




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