<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'hide_xframe_notice',
        'ip_address',
        'user_agent',
        'enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'enabled' => true,
        'hide_xframe_notice' => false,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userFeeds(): hasMany
    {
        return $this->hasMany(UserFeed::class);
    }

    public function feedItems(): hasMany
    {
        return $this->hasMany(UserFeedItem::class);
    }

    public function checklistItems(): hasMany
    {
        return $this->hasMany(ChecklistItem::class);
    }

    public function notes(): hasMany
    {
        return $this->hasMany(Note::class);
    }

    public function settings(): hasMany
    {
        return $this->hasMany(UserSetting::class);
    }
}
