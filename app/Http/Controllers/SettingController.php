<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class SettingController extends BaseController
{
    public function index()
    {
        return view('settings.index', [
            'bodyClass' => 'settings',
            'isAdmin' => Auth::user()->is_admin,
            'availableFeeds' => [],
            'userFeeds' => Auth::user()->userFeeds,
            'users' => User::all()
        ]);
    }

    public function add()
    {
        // TODO: Add functionality to method
    }

    public function follow()
    {
        // TODO: Add functionality to method
    }

    public function update()
    {
        // TODO: Add functionality to method
    }

    public function remove()
    {
        // TODO: Add functionality to method
    }

    public function disableXFrameNotice()
    {
        // TODO: Add functionality to method
    }

    public function validateUrl()
    {
        // TODO: Add functionality to method
    }

    public function createUserFeed()
    {
        // TODO: Add functionality to method
    }
}
