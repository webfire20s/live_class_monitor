<?php

namespace App\Repositories;

use App\Models\SystemSetting;

class SettingRepository extends BaseRepository
{
    /**
     * SettingRepository constructor.
     *
     * @param SystemSetting $model
     */
    public function __construct(SystemSetting $model)
    {
        parent::__construct($model);
    }

    /**
     * Find a setting by its key.
     *
     * @param string $key
     * @return SystemSetting|null
     */
    public function findByKey(string $key): ?SystemSetting
    {
        return $this->model->where('key', $key)->first();
    }

    /**
     * Update or create a setting by key.
     */
    public function set(string $key, $value): SystemSetting
    {
        return $this->model->updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
