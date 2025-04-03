<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class RedirectIfVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->email_verified_at) {
            return redirect()->route('auth.login')->with('success', 'Your account is already verified. Please log in.');
        }

        return $next($request);
    }
}
