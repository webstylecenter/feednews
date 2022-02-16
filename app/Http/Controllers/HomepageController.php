<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use App\Repositories\UserRepository;
use Detection\MobileDetect;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomepageController extends BaseController
{
    public function index(MobileDetect $mobileDetect, UserRepository $userRepository, Weather $weather): View
    {
        return view('home.index', [
            'bodyClass' => 'Homepage',
            'device' => $mobileDetect,
            'user' => Auth::user(),
            'userFeedItems' => $userRepository->getFeedItems(50, 0),
            'userFeedSettings' => Auth::user()->settings ?? [],
            'forecast' => $weather::where('location', '=', 'Eindhoven,NL')->first(),
            'nextPageNumber' => 1,
        ]);
    }

    public function offline(): View
    {
        return view('home.offline', [
            'bodyClass' => 'offline'
        ]);
    }

    public function privacyPolicy(): View
    {
        return view('user.privacy', ['bodyClass' => 'privacy']);
    }
}
