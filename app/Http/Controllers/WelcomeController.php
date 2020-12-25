<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class WelcomeController extends BaseController
{
    public function index(): View
    {
        app('debugbar')->disable();

        return view('welcome.index', [
            'bodyClass' => 'page--homepage',
            'notes' => [],
            'todos' => []
        ]);
    }
}
