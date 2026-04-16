<?php

namespace App\Services;

use App\Repositories\SettingRepository;

class SettingService
{
    /**
     * The live session service instance.
     *
     * @var LiveSessionService
     */
    protected $liveSessionService;

    /**
     * SettingService constructor.
     *
     * @param SettingRepository $settingRepository
     * @param LiveSessionService $liveSessionService
     */
    public function __construct(SettingRepository $settingRepository, LiveSessionService $liveSessionService)
    {
        $this->settingRepository = $settingRepository;
        $this->liveSessionService = $liveSessionService;
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
    public function updateSettings(array $settings, int $adminId)
    {
        $youtubeVideoId = $settings['current_youtube_video_id'] ?? $this->getYouTubeVideoId();

        foreach ($settings as $key => $value) {
            // Check if we are changing the active status
            if ($key === 'active_class_status') {
                $currentValue = $this->isClassActive();
                $newValue = filter_var($value, FILTER_VALIDATE_BOOLEAN);

                if ($currentValue !== $newValue) {
                    if ($newValue) {
                        $this->liveSessionService->startNewSession($adminId, $youtubeVideoId);
                    } else {
                        $this->liveSessionService->closeActiveSessions();
                    }
                }
            }

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
