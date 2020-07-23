<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    private function authRedirect(string $to)
    {
        $frontEndUrl = config('app.url');
        return redirect($frontEndUrl . $to);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->stateless()->user();
        } catch (Exception $e) {
            return $this->authRedirect("/login");
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser = new User();
            $newUser->provider_name = $driver;
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar = $user->getAvatar();
            $newUser->save();
            auth()->login($newUser, true);

            $existingUser = $newUser;
        }

        $token = $existingUser->createToken($existingUser->email . '-' . now());

        $query = http_build_query(['token' => $token->accessToken]);
        return $this->authRedirect('/complete_login?' . $query);
    }
}
