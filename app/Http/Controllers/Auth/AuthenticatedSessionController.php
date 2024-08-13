<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse

    {
        $user = User::where('email', $request['email'])->first();
        if ($user) {
            if ($user->email_verified_at == null) {
                event(new Registered($user));
                return redirect()->route('login')->with('messageRegister', 
                'Please verify your email address!'
            );
            } else {

                $request->authenticate();

                $request->session()->regenerate();
                return redirect()->intended(route('home', absolute: false));
            }
        } else {

            return redirect()->route('login')->with('messageRegister', 'This email address is not registered!');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
