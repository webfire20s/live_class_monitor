<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StudentLoginController extends Controller
{
    /**
     * Show the student login form.
     */
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    /**
     * Handle a student login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'student_unique_id' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::guard('student')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('student.dashboard'));
        }

        throw ValidationException::withMessages([
            'student_unique_id' => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the student out of the application.
     */
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }
}
