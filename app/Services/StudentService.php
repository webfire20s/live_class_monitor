<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Hash;

class StudentService
{
    /**
     * The student repository instance.
     *
     * @var StudentRepository
     */
    protected $studentRepository;

    /**
     * StudentService constructor.
     *
     * @param StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Get all students for a college.
     */
    public function getCollegeStudents(int $collegeId)
    {
        return $this->studentRepository->getByCollege($collegeId);
    }

    /**
     * Create a new student for a college.
     */
    public function createStudent(array $data)
    {
        if (empty($data['password'])) {
            $data['password'] = Hash::make($data['student_unique_id']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->studentRepository->create($data);
    }

    /**
     * Update an existing student.
     */
    public function updateStudent(int $id, array $data, int $collegeId)
    {
        $student = $this->studentRepository->find($id);

        if (!$student || $student->college_id !== $collegeId) {
            return false;
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->studentRepository->update($data, $id);
    }

    /**
     * Delete a student.
     */
    public function deleteStudent(int $id, int $collegeId)
    {
        $student = $this->studentRepository->find($id);

        if (!$student || $student->college_id !== $collegeId) {
            return false;
        }

        return $this->studentRepository->delete($id);
    }

    /**
     * Find a student by ID.
     */
    public function findStudent(int $id)
    {
        return $this->studentRepository->find($id);
    }

    /**
     * Generate the next available sequential Student ID for a college.
     */
    public function generateNextStudentId(\App\Models\College $college): string
    {
        $prefix = $college->college_code . '-';
        
        $lastStudent = \App\Models\Student::where('college_id', $college->id)
            ->where('student_unique_id', 'LIKE', $prefix . '%')
            ->orderBy('student_unique_id', 'desc')
            ->first();

        if (!$lastStudent) {
            return $prefix . '0001';
        }

        $lastId = $lastStudent->student_unique_id;
        $lastNumber = (int) str_replace($prefix, '', $lastId);
        $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return $prefix . $nextNumber;
    }
}
