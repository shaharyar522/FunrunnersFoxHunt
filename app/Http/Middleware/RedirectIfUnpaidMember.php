<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class RedirectIfUnpaidMember
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'member') {
            $member = Member::where('user_id', $user->id)->first();

            // If no member record exists or they haven't paid, send them to payment
            if (!$member || $member->payment_status == 0) {
                // Allow access to the onboarding/payment routes to avoid infinite loop
                if (!$request->is('member/onboarding*')) {
                    return redirect()->route('member.onboarding.index');
                }
            }
        }

        return $next($request);
    }
    
}
