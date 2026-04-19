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
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // First attempt to find the college to check if it's active
        $college = \App\Models\College::where('username', $request->username)->first();

        if ($college && !$college->is_active) {
            throw ValidationException::withMessages([
                'username' => ['Your account is pending approval by the main administrator.'],
            ]);
        }

        if (Auth::guard('college')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('college.dashboard'));
        }

        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
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
