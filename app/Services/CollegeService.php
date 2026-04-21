<?php

namespace App\Services;

use App\Repositories\CollegeRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CollegeService
{
    /**
     * The college repository instance.
     *
     * @var CollegeRepository
     */
    protected $collegeRepository;

    /**
     * CollegeService constructor.
     *
     * @param CollegeRepository $collegeRepository
     */
    public function __construct(CollegeRepository $collegeRepository)
    {
        $this->collegeRepository = $collegeRepository;
    }

    /**
     * Get all colleges.
     */
    public function getAllColleges()
    {
        return $this->collegeRepository->all();
    }

    /**
     * Create a new college.
     */
    public function createCollege(array $data)
    {
        if (empty($data['college_code'])) {
            $data['college_code'] = $this->generateUniqueCode($data['name']);
        }

        if (empty($data['username'])) {
            $data['username'] = explode('@', $data['email'])[0] . rand(10, 99);
        }

        $data['password'] = Hash::make($data['password']);

        return $this->collegeRepository->create($data);
    }

    /**
     * Update an existing college.
     */
    public function updateCollege(int $id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->collegeRepository->update($data, $id);
    }

    /**
     * Delete a college.
     */
    public function deleteCollege(int $id)
    {
        return $this->collegeRepository->delete($id);
    }

    /**
     * Generate a unique college code based on name.
     */
    protected function generateUniqueCode(string $name): string
    {
        $base = strtoupper(substr(Str::slug($name, ''), 0, 4));
        $code = $base . rand(100, 999);

        while ($this->collegeRepository->findByCode($code)) {
            $code = $base . rand(100, 999);
        }

        return $code;
    }

    /**
     * Find a college by ID.
     */
    public function findCollege(int $id)
    {
        return $this->collegeRepository->find($id);
    }
}
