<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository
{
    /**
     * The model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of model.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a record in the database.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, $id): bool
    {
        $record = $this->model->find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    /**
     * Delete a record from the database.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }

    /**
     * Find a record by its primary key.
     *
     * @param int $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
}
