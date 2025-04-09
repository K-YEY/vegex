<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCountView extends Model
{
    protected $table = "video_count_view";
    protected $fillable = [
        'userId',
        'video_group_id',
        'video_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function videoGroup()
    {
        return $this->belongsTo(GroupVideo::class, 'video_group_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
