<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_path', 'rate', 'duration', 'is_active', 'is_free','count_view','cover'];

    protected $appends = ['previousVideo', 'nextVideo'];

    public function videoGroups(): HasMany
    {
        return $this->hasMany(VideoGroup::class, 'video_id');
    }

    /**
     * Get the previous video in the same group
     */
    public function getPreviousVideoAttribute()
    {
        // Get all videos in the same group as this video
        $groupIds = $this->videoGroups->pluck('video_group_id');

        if ($groupIds->isEmpty()) {
            return null;
        }

        // Find videos in the same group with a lower ID
        return Video::whereIn('id', function ($query) use ($groupIds) {
                $query->select('video_id')
                    ->from('video_group')
                    ->whereIn('video_group_id', $groupIds);
            })
            ->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    /**
     * Get the next video in the same group
     */
    public function getNextVideoAttribute()
    {
        // Get all videos in the same group as this video
        $groupIds = $this->videoGroups->pluck('video_group_id');

        if ($groupIds->isEmpty()) {
            return null;
        }

        // Find videos in the same group with a higher ID
        return Video::whereIn('id', function ($query) use ($groupIds) {
                $query->select('video_id')
                    ->from('video_group')
                    ->whereIn('video_group_id', $groupIds);
            })
            ->where('id', '>', $this->id)
            ->orderBy('id', 'asc')
            ->first();
    }
}
