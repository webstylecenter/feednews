<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedListFilter extends Model
{
    const FEEDLIST_MAX_ITEMS = 50;

    protected $user;
    protected $limit = self::FEEDLIST_MAX_ITEMS;
    protected $page = 1;
    protected $searchQuery;
    protected $newOnly = false;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): FeedListFilter
    {
        $this->user = $user;
        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): FeedListFilter
    {
        $this->limit = $limit;
        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): FeedListFilter
    {
        $this->page = $page;
        return $this;
    }

    public function getSearchQuery(): string
    {
        return $this->searchQuery;
    }

    public function setSearchQuery(string $searchQuery): FeedListFilter
    {
        $this->searchQuery = $searchQuery;
        return $this;
    }

    public function isNewOnly(): bool
    {
        return $this->newOnly;
    }

    public function setNewOnly(bool $newOnly): FeedListFilter
    {
        $this->newOnly = $newOnly;
        return $this;
    }

    public function getIndex(): int
    {
        return ($this->page < 1 ? 1 : $this->page) - 1;
    }
}
