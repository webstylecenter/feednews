<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class SettingController extends BaseController
{
    public function index()
    {
        // TODO: Add functionality to method
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

    /**
     * TODO: Replace this with a helper of some sorts
     *
     * @return string
     */
    protected function generateRandomColor(): string
    {
        return round(rand(0, 9)) .
            round(rand(0, 9)) .
            round(rand(0, 9)) .
            round(rand(0, 9)) .
            round(rand(0, 9)) .
            round(rand(0, 9));           ;
    }
}
