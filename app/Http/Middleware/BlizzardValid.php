<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class BlizzardValid
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = Auth::user();
        $isTokenValid = Socialite::driver('blizzard')->stateless()->isTokenValid($user->provider_token);

        if (!$isTokenValid) {
            return response()->json(['success' => false, 'message' => 'blizzard session expired'], 400);
        }
        return $next($request);
    }
}
