<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class StudentController extends Controller
{
    /**
     * The student service instance.
     *
     * @var StudentService
     */
    protected $studentService;

    /**
     * StudentController constructor.
     *
     * @param StudentService $studentService
     */
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Show the student upload form.
     */
    public function showUploadForm()
    {
        return view('college.students.upload');
    }

    /**
     * Handle the Excel import request.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $import = new StudentsImport();
        
        try {
            Excel::import($import, $request->file('file'));

            $message = 'Students imported successfully.';
            if (!empty($import->failures)) {
                $count = count($import->failures);
                $message .= " However, {$count} rows were skipped due to validation errors.";
                return redirect()->route('college.students.index')
                    ->with('success', $message)
                    ->with('import_failures', $import->failures);
            }

            return redirect()->route('college.students.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during import: ' . $e->getMessage());
        }
    }

    /**
     * Display a listing of the students for the logged-in college.
     */
    public function index()
    {
        $collegeId = Auth::guard('college')->id();
        $students = $this->studentService->getCollegeStudents($collegeId);
        
        return view('college.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $college = Auth::guard('college')->user();
        $suggestedId = $this->studentService->generateNextStudentId($college);

        return view('college.students.create', compact('suggestedId'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $collegeId = Auth::guard('college')->id();

        $request->validate([
            'student_unique_id' => 'required|string|max:50|unique:students,student_unique_id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = $request->all();
        $data['college_id'] = $collegeId;

        $this->studentService->createStudent($data);

        return redirect()->route('college.students.index')
            ->with('success', 'Student added successfully.');
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit($id)
    {
        $collegeId = Auth::guard('college')->id();
        $student = $this->studentService->findStudent($id);

        if (!$student || $student->college_id !== $collegeId) {
            return redirect()->route('college.students.index')
                ->with('error', 'Student not found or unauthorized access.');
        }

        return view('college.students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, $id)
    {
        $collegeId = Auth::guard('college')->id();

        $request->validate([
            'student_unique_id' => 'required|string|max:50|unique:students,student_unique_id,' . $id,
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $success = $this->studentService->updateStudent($id, $request->all(), $collegeId);

        if (!$success) {
            return redirect()->route('college.students.index')
                ->with('error', 'Failed to update student.');
        }

        return redirect()->route('college.students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy($id)
    {
        $collegeId = Auth::guard('college')->id();
        $success = $this->studentService->deleteStudent($id, $collegeId);

        if (!$success) {
            return redirect()->route('college.students.index')
                ->with('error', 'Failed to delete student.');
        }

        return redirect()->route('college.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
