<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    /**
     * @var array
     */
    public $failures = [];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $collegeId = Auth::guard('college')->id();

        return new Student([
            'college_id'        => $collegeId,
            'student_unique_id' => $row['student_id'],
            'name'              => $row['name'],
            'email'             => $row['email'] ?? null,
            'phone'             => $row['phone'] ?? null,
            'password'          => Hash::make($row['student_id']), // Default password
        ]);
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|string|unique:students,student_unique_id',
            'name'       => 'required|string',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string',
        ];
    }

    /**
     * Handle failed rows.
     */
    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->failures[] = [
                'row' => $failure->row(),
                'errors' => $failure->errors(),
                'values' => $failure->values(),
            ];
        }
    }
}
