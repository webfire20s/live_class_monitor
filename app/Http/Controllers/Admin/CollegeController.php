<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CollegeService;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * The college service instance.
     *
     * @var CollegeService
     */
    protected $collegeService;

    /**
     * CollegeController constructor.
     *
     * @param CollegeService $collegeService
     */
    public function __construct(CollegeService $collegeService)
    {
        $this->collegeService = $collegeService;
    }

    /**
     * Display a listing of the colleges.
     */
    public function index()
    {
        $colleges = $this->collegeService->getAllColleges();
        return view('admin.colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new college.
     */
    public function create()
    {
        return view('admin.colleges.create');
    }

    /**
     * Store a newly created college in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'college_code' => 'nullable|string|max:50|unique:colleges,college_code',
            'email' => 'required|email|max:255|unique:colleges,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $this->collegeService->createCollege($request->all());

        return redirect()->route('admin.colleges.index')
            ->with('success', 'College created successfully.');
    }

    /**
     * Show the form for editing the specified college.
     */
    public function edit($id)
    {
        $college = $this->collegeService->findCollege($id);
        return view('admin.colleges.edit', compact('college'));
    }

    /**
     * Update the specified college in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'college_code' => 'required|string|max:50|unique:colleges,college_code,' . $id,
            'email' => 'required|email|max:255|unique:colleges,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $this->collegeService->updateCollege($id, $request->all());

        return redirect()->route('admin.colleges.index')
            ->with('success', 'College updated successfully.');
    }

    /**
     * Remove the specified college from storage.
     */
    public function destroy($id)
    {
        $this->collegeService->deleteCollege($id);

        return redirect()->route('admin.colleges.index')
            ->with('success', 'College deleted successfully.');
    }
}
