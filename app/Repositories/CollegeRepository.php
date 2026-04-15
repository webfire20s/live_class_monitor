<?php

namespace App\Repositories;

use App\Models\College;

class CollegeRepository extends BaseRepository
{
    /**
     * CollegeRepository constructor.
     *
     * @param College $model
     */
    public function __construct(College $model)
    {
        parent::__construct($model);
    }

    /**
     * Find a college by its unique code.
     *
     * @param string $code
     * @return College|null
     */
    public function findByCode(string $code): ?College
    {
        return $this->model->where('college_code', $code)->first();
    }
}
