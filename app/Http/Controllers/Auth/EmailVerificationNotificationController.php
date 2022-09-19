<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->get()[0];
        // if ($request->user()->hasVerifiedEmail()) {
        if ($user->hasVerifiedEmail()) {
            // return redirect()->intended(RouteServiceProvider::HOME);
            return redirect('/login');
        }

        // $request->user()->sendEmailVerificationNotification();
        $user->sendEmailVerificationNotification();

        // return back()->with('status', 'verification-link-sent');
        return redirect('/login');
    }
}
