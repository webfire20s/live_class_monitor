<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CollegeLoginController extends Controller
{
    /**
     * Show the college login form.
     */
    public function showLoginForm()
    {
        return view('auth.college-login');
    }

    /**
     * Handle a college login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('college')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('college.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the college out of the application.
     */
    public function logout(Request $request)
    {
        Auth::guard('college')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('college.login');
    }
}
