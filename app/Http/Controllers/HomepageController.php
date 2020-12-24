<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Detection\MobileDetect;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class HomepageController extends BaseController
{
    public function index(MobileDetect $mobileDetect, UserRepository $userRepository)
    {
        return view('home.index', [
            'bodyClass' => 'Homepage',
            'device' => $mobileDetect,
            'user' => Auth::user(),
            'userFeedItems' => $userRepository->getFeedItems(),
            'userFeedSettings' => Auth::user()->settings ?? [],
            'forecast' => []
        ]);
    }

    public function offline()
    {
        // TODO: Add functionality to method
    }

    public function privacyPolicy()
    {
        return view('user.privacy', ['bodyClass' => 'privacy']);
    }
}
