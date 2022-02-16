<?php

namespace App\Models;

use Carbon\Carbon;

class NewsFeedItem
{
    public string $guid;
    public string $title;
    public string $description;
    public string $url;
    public Carbon $created_at;
    public Carbon $opened_at;
    public bool $viewed;
    public bool $pinned;
    public bool $visible;
}
