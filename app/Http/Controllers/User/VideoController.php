<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GroupVideo;
use App\Models\Video;
use App\Models\VideoGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    private $_route_view;
    public function __construct(){
        $this->_route_view = 'dashboard.video.index';
    }

    public function index(){
        return view($this->_route_view);
    }
    /**
     * Display a single video with navigation to previous and next videos
     *
     * @param int $id The video ID
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Get the video
        $video = Video::findOrFail($id);

        // Get the current user ID
        $userId = Auth::id();

        // Find the video group this video belongs to
        $videoGroup = VideoGroup::where('video_id', $id)->first();

        if (!$videoGroup) {
            // If no direct connection, try to find through group video
            $groupVideoId = Video::join('video_group', 'videos.id', '=', 'video_group.video_id')
                ->where('videos.id', $id)
                ->pluck('video_group.video_group_id')
                ->first();

            if ($groupVideoId) {
                $groupVideo = GroupVideo::findOrFail($groupVideoId);

                // Create a temporary VideoGroup object
                $videoGroup = new VideoGroup();
                $videoGroup->videoGroup = $groupVideo;
            }
        }

        // Get all videos in this group for the video list
        if (isset($videoGroup->videoGroup)) {
            // Case when we have a temporary VideoGroup object with GroupVideo reference
            $videos = Video::whereIn('id', function ($query) use ($videoGroup) {
                $query->select('video_id')
                    ->from('video_group')
                    ->where('video_group_id', $videoGroup->videoGroup->id);
            })->get();
        } elseif ($videoGroup) {
            // Case when we have a direct VideoGroup record
            $videos = Video::whereIn('id', function ($query) use ($videoGroup) {
                $query->select('video_id')
                    ->from('video_group')
                    ->where('video_group_id', $videoGroup->video_group_id);
            })->get();
        } else {
            // Fallback if no group is found
            $videos = collect([$video]);
        }

        return view('dashboard.video.single-video', compact('video', 'videoGroup', 'videos', 'userId'));
    }
}
