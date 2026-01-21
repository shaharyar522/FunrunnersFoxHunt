<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    // -------------------
    // GOOGLE LOGIN
    // -------------------
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        $socialUser = Socialite::driver('google')->user();
        $user = $this->findOrCreateUser($socialUser, 'google');
        Auth::login($user);
        return $this->redirectToDashboard($user);
        
    }

    // -------------------
    // TWITTER/X LOGIN
    // -------------------
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        $socialUser = Socialite::driver('twitter')->user();
        $user = $this->findOrCreateUser($socialUser, 'twitter');
        Auth::login($user);
        return $this->redirectToDashboard($user);
    }

    // -------------------
    // FACEBOOK LOGIN MOCK
    // -------------------
    public function redirectToFacebookMock()
    {
        $user = User::firstOrCreate(
            ['email' => 'fbuser@test.com'],
            [
                'name' => 'Facebook Test User',
                'provider' => 'facebook',
                'provider_id' => '12345',
                'password' => bcrypt(uniqid()),
            ]
        );
        Auth::login($user);
        return $this->redirectToDashboard($user);
    }

    // -------------------
    // HELPER: Find or create user
    // -------------------
    private function findOrCreateUser($socialUser, $provider)
    {
        $user = User::where('provider_id', $socialUser->id)
                    ->where('provider', $provider)
                    ->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email ?? $socialUser->id.'@'.$provider.'.com',
                'provider' => $provider,
                'provider_id' => $socialUser->id,
                'password' => bcrypt(uniqid()), // dummy password
            ]);
        }

        return $user;
    }

    // -------------------
    // HELPER: Redirect based on role
    // -------------------
    private function redirectToDashboard($user)
    {
        // Assuming your users table has a 'role' column: 'contestant', 'member', 'admin'
        if ($user->role == 'contestant') return redirect('/contestant-dashboard');
        if ($user->role == 'member') return redirect('/member-dashboard');
        return redirect('/admin-dashboard');
    }

}
