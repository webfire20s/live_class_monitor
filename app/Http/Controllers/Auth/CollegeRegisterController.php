<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\College;
use Illuminate\Support\Facades\Hash;

class CollegeRegisterController extends Controller
{
    /**
     * Show the college registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.college-register');
    }

    /**
     * Handle a college registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'college_code' => 'required|string|max:50|unique:colleges',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:colleges',
            'username' => 'required|string|max:50|unique:colleges',
            'password' => 'required|string|min:8|confirmed',
        ]);

        College::create([
            'name' => $request->name,
            'college_code' => $request->college_code,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'is_active' => false, // Needs admin approval
        ]);

        return redirect()->route('college.login')
            ->with('success', 'Registration successful! Please wait for admin approval before logging in.');
    }
}
