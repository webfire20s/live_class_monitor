<?php

namespace App\Services;

use App\Repositories\SettingRepository;

class SettingService
{
    /**
     * The setting repository instance.
     *
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * SettingService constructor.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Get a setting value by key.
     */
    public function getSetting(string $key, $default = null)
    {
        $setting = $this->settingRepository->findByKey($key);
        return $setting ? $setting->value : $default;
    }

    /**
     * Update multiple settings.
     */
    public function updateSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            $this->settingRepository->set($key, $value);
        }
    }

    /**
     * Get the current YouTube Video ID.
     */
    public function getYouTubeVideoId(): string
    {
        return $this->getSetting('current_youtube_video_id', '');
    }

    /**
     * Check if class is active.
     */
    public function isClassActive(): bool
    {
        return filter_var($this->getSetting('active_class_status', 'false'), FILTER_VALIDATE_BOOLEAN);
    }
}
