<?php

namespace App\Repositories;

use App\Models\ChecklistItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ChecklistRepository
{
    protected User $user;
    protected ChecklistItem $checklistItem;

    public function __construct(ChecklistItem $checklistItem)
    {
        $this->user = Auth::user();
        $this->checklistItem = $checklistItem;
    }

    public function getTodos(): Collection
    {
        return $this->user->checklistItems()
            ->where('checked', '=', false)
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function getFinished(): Collection
    {
        return $this->user->checklistItems()
            ->where('checked', '=', true)
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function add(string $item): void
    {
        $this->checklistItem->user_id = $this->user->id;
        $this->checklistItem->item = $item;
        $this->checklistItem->save();
    }

    public function update(int $checklistItemId): void
    {
        $checklistItem = $this->checklistItem->where('id', '=', $checklistItemId)->where('user_id', '=', $this->user->id)->first();
        $checklistItem->user_id = $this->user->id;
        $checklistItem->checked = !$checklistItem->checked;
        $checklistItem->save();
    }
}
