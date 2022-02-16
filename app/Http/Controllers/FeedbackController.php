<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class FeedbackController extends BaseController
{
    public function index()
    {
        return view('feedback.index', ['bodyClass' => 'feedback']);
    }
}
