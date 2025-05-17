<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupVideo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'discount', 'count_subscribers', 'total_videos', 'max_videos', 'join_max', 'rate', 'duration', 'cover'];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
