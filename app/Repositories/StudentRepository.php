<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository extends BaseRepository
{
    /**
     * StudentRepository constructor.
     *
     * @param Student $model
     */
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all students for a specific college.
     *
     * @param int $collegeId
     * @return Collection
     */
    public function getByCollege(int $collegeId): Collection
    {
        return $this->model->where('college_id', $collegeId)->get();
    }

    /**
     * Find a student by unique ID within a college.
     */
    public function findByUniqueId(string $uniqueId, int $collegeId): ?Student
    {
        return $this->model->where('student_unique_id', $uniqueId)
            ->where('college_id', $collegeId)
            ->first();
    }
}
