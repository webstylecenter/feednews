<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;


class OverlayFormsController extends BaseController
{
    public function addNewFeedItem(): View
    {
        return view('overlay-forms.add-feed-item');
    }
}
