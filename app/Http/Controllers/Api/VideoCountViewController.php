<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GroupVideo;
use App\Models\Video;
use App\Models\VideoCountView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoCountViewController extends Controller
{
    /**
     * Record a view when user watches half of a video
     *
     * @param int $id The video ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($id, $groupId, $rate, $isView = false)
    {
        // Find the video
        $video = Video::findOrFail($id);

        // Get current user ID or use session ID for guests
        $userId = Auth::id();
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User is not authenticated',
            ], 401);
        }

        // Check if this user/session has already viewed this video
        $existingView = VideoCountView::where('video_id', $id)
            ->where('video_group_id', $groupId)
            ->where('userId', $userId)
            ->first();

        if ($isView) {
            if (!$existingView) {
                // Create new view record without rating
                $viewData = [
                    'video_id' => $id,
                    'video_group_id' => $groupId,
                    'userId' => $userId
                ];

                VideoCountView::create($viewData);

                // Increment the view count on the video
                $video->increment('count_view');
            }
        } else {

            if (!$existingView) {
                // Create new record with only rating
                VideoCountView::create([
                    'video_id' => $id,
                    'video_group_id' => $groupId,
                    'rate' => $rate,
                    'userId' => $userId
                ]);

                $this->recalculateRating($id, $groupId);
            } else if ($rate != $existingView->rate) {
                // Update existing view's rate if different
                $existingView->rate = $rate;
                $existingView->save();

                // Recalculate rating after update
                $this->recalculateRating($id, $groupId);
            }
        }

        return response()->json([
            'success' => true,
            'count_view' => $video->fresh()->count_view,
            'rating' => $video->fresh()->rate,
            'test' => $rate
        ]);
    }

    /**
     * Recalculate video rating based on views
     *
     * @param int $videoId
     * @return void
     */
    private function recalculateRating($videoId, $groupId)
    {
        // Get all ratings for this video
        $ratings = VideoCountView::where('video_id', $videoId)->where('video_group_id', $groupId)
            ->whereNotNull('rate')
            ->pluck('rate');

        // Calculate average rating
        if ($ratings->count() > 0) {
            $averageRating = $ratings->avg();
            // Update video rating
            $groupVideo = GroupVideo::find($groupId);
            $groupVideo->rate = $averageRating;
            $groupVideo->save();

            // Update video rating
            $video = Video::find($videoId);
            $video->rate = $averageRating;
            $video->save();
        }
    }
}
