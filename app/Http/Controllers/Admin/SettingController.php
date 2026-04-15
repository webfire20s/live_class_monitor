<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * The setting service instance.
     *
     * @var SettingService
     */
    protected $settingService;

    /**
     * SettingController constructor.
     *
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display the system settings.
     */
    public function index()
    {
        $settings = [
            'active_class_status' => $this->settingService->isClassActive(),
            'current_youtube_video_id' => $this->settingService->getYouTubeVideoId(),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update the system settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_youtube_video_id' => 'nullable|string|max:50',
            'active_class_status' => 'required|in:true,false',
        ]);

        $this->settingService->updateSettings($request->only([
            'current_youtube_video_id',
            'active_class_status'
        ]));

        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully.');
    }
}
