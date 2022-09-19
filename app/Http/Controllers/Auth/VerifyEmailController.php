<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use
    App\Http\Requests\UserEmailVerificationRequest; // use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UserEmailVerificationRequest $request, $id)
    {
        $user = User::find($id);
        if ($user->hasVerifiedEmail()) {
            // return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
            return redirect('/login');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        return redirect('/login');
    }
}
