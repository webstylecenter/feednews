<?php

namespace App\Http\Controllers;

use App\Repositories\ChecklistRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class ChecklistController extends BaseController
{
    public function index(ChecklistRepository $checklistRepository): View
    {
        return view('checklist.index', [
            'bodyClass' => 'checklist',
            'todos' => $checklistRepository->getTodos(),
            'finished' =>  $checklistRepository->getFinished(),
        ]);
    }

    public function add(Request $request, ChecklistRepository $checklistRepository): View
    {
        $request->validate([
            'item' => ['required', 'min:3']
        ]);

        $checklistRepository->add($request->get('item'));

        return view('checklist.checklist', [
            'todos' => $checklistRepository->getTodos(),
            'finished' =>  $checklistRepository->getFinished(),
        ]);
    }

    public function update(Request $request, ChecklistRepository $checklistRepository): View
    {
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $checklistRepository->update($request->get('id'));

        return view('checklist.checklist', [
            'todos' => $checklistRepository->getTodos(),
            'finished' =>  $checklistRepository->getFinished(),
        ]);
    }
}
