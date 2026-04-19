<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\College;
use Illuminate\Support\Facades\Hash;

class StudentRegisterController extends Controller
{
    /**
     * Show the student registration form.
     */
    public function showRegistrationForm()
    {
        $colleges = College::where('is_active', true)->get();
        return view('auth.student-register', compact('colleges'));
    }

    /**
     * Handle a student registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'class_name' => 'required|string|max:100',
            'student_unique_id' => 'required|string|max:50|unique:students',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Student::create([
            'college_id' => $request->college_id,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'class_name' => $request->class_name,
            'student_unique_id' => $request->student_unique_id,
            'password' => Hash::make($request->password),
            'is_approved' => false, // Needs college admin approval
        ]);

        return redirect()->route('student.login')
            ->with('success', 'Registration successful! Please wait for your college to approve your account before logging in.');
    }
}
