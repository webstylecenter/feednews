<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class NoteController extends BaseController
{
    public function save(Request $request, Note $note): array
    {
        $request->validate([
            'note' => 'required'
        ]);

        if ($request->get('id')) {
            $note = Note::where('id', '=', $request->get('id'))->where('user_id', '=', Auth::user()->id);

            if (!$note) {
                abort(403);
            }
        } else {
            $note->user_id = Auth::user()->id;
        }

        $note->name = $request->get('name');
        $note->content = $request->get('note');
        $note->position = $request->get('position') ?? 0;
        $note->save();

        return [
            'status' => 'success',
            'data' => [
                'id' => $note->id
            ]
        ];
    }

    public function remove(Request $request): array
    {
        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $note = Note::where('id', '=', $request->get('id'))->where('user_id', '=', Auth::user()->id);

        if (!$note) {
            abort(403);
        }

        $note->delete();

        return [
            'status' => 'success'
        ];
    }
}
