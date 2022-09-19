<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.login');
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\UserLoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(LoginRequest $request)
    public function store(UserLoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        $user = Auth::user();
        if ($user->hasVerifiedEmail()) {
            return redirect('/');
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/verify-email');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
