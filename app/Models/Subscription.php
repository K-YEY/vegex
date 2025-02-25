<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'group_video_id', 'rate'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function groupVideo(): BelongsTo
    {
        return $this->belongsTo(GroupVideo::class);
    }
}
