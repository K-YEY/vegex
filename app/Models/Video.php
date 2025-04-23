<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_path', 'rate', 'is_active', 'is_free','count_view','cover'];

    public function videoGroups(): HasMany
    {
        return $this->hasMany(VideoGroup::class, 'video_id');
    }
}
