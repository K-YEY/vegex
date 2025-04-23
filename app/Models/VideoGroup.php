<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGroup extends Model
{
    protected $table = "video_group";
    protected $fillable = [
        'video_group_id',
        'video_id',
    ];

    public function videoGroup()
    {
        return $this->belongsTo(GroupVideo::class, 'video_group_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
