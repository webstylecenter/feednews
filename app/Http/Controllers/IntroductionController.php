<?php

namespace App\Http\Controllers;

use App\Models\FeedCategory;
use App\Services\FeedService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IntroductionController extends BaseController
{
    public function index(Auth $auth, FeedCategory $feedCategory): View
    {
        return view('introduction.start', [
            'user' => $auth::user(),
            'bodyClass' => 'introduction',
            'categories' => $feedCategory::all()
        ]);
    }
}
