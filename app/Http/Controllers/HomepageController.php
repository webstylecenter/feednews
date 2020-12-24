<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class HomepageController extends BaseController
{
    public function index()
    {
        return view('welcome', ['bodyClass' => 'homepage']);
        // TODO: Add functionality to method
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
