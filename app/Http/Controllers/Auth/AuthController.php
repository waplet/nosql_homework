<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Auth;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        if (!$user) {
            return redirect('/')->with('message', 'Something went wrong!');
        }

        $email = $user->getEmail();
        $localUser = User::where('email', '=', $email)->first();

        if ($localUser) {
            if (Auth::login($localUser)) {
                return redirect('/home');
            }
            return redirect('/register')->with('message', 'Could not login in with you Github Account');
        }

        return redirect('/register')->with('email', $email);
    }
}
