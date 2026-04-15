<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * The setting service instance.
     *
     * @var SettingService
     */
    protected $settingService;

    /**
     * DashboardController constructor.
     *
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        
        $sessionData = [
            'is_active' => $this->settingService->isClassActive(),
            'video_id'  => $this->settingService->getYouTubeVideoId(),
        ];

        return view('student.dashboard', compact('student', 'sessionData'));
    }
}
