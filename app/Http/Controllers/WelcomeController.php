<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Repositories\ChecklistRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WelcomeController extends BaseController
{
    public function index(ChecklistRepository $checklistRepository): View
    {
        // app('debugbar')->disable(); TODO: Triggers error on production

        return view('welcome.index', [
            'bodyClass' => 'page--homepage',
            'notes' => Note::where('user_id', '=', Auth::user()->id)->get(),
            'todos' => $checklistRepository->getTodos()
        ]);
    }
}
