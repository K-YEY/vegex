<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GroupVideo;
use App\Models\Video;
use App\Models\VideoCountView;
use App\Models\VideoGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    private $_route_view, $_route_view_video;

    public function __construct()
    {
        $this->_route_view = 'dashboard.video.videos-group';
        $this->_route_view_video = 'dashboard.video.index';
    }

    /**
     * Display a listing of the video groups
     */
    public function index()
    {
        $videoGroups = GroupVideo::all();
        return view($this->_route_view, compact('videoGroups'));
    }

    /**
     * Display the specified video group with its videos
     */
    public function show($id)
    {
        // Find the VideoGroup record that connects to the GroupVideo
        $videoGroup = VideoGroup::where('video_group_id', $id)->first();

        if (!$videoGroup) {
            // If no connection exists, create a new view with just the GroupVideo
            $groupVideo = GroupVideo::findOrFail($id);
            $videos = [];

            // Create a temporary VideoGroup object to match the view's expectations
            $videoGroup = new VideoGroup();
            $videoGroup->videoGroup = $groupVideo;

            return view($this->_route_view, compact('videoGroup', 'videos'));
        }

        // Get all videos in this group
        $videos = Video::whereIn('id', function ($query) use ($id) {
            $query->select('video_id')
                ->from('video_group')
                ->where('video_group_id', $id);
        })
            ->where('is_active', 1)
            ->get();

        return view($this->_route_view, compact('videoGroup', 'videos'));
    }

    /**
     * Show the subscription form for a video group
     */
    public function subscribe($id)
    {
        $groupVideo = GroupVideo::findOrFail($id);
        return view('dashboard.video.subscribe', compact('groupVideo'));
    }


    public function showVideos($id)
    {
        // Find the VideoGroup record that connects to the GroupVideo
        $videoGroup = VideoGroup::where('video_group_id', $id)->first();
        $groupVideo = '';
        if (!$videoGroup) {
            // If no connection exists, create a new view with just the GroupVideo
            $groupVideo = GroupVideo::findOrFail($id);
            $videos = [];

            // Create a temporary VideoGroup object to match the view's expectations
            $videoGroup = new VideoGroup();
            $videoGroup->videoGroup = $groupVideo;
        }

        // Get all videos in this group
        $videos = Video::whereIn('id', function ($query) use ($id) {
            $query->select('video_id')
                ->from('video_group')
                ->where('video_group_id', $id);
        })->where('is_active', 1)->get();

        // Check if the current user is an admin
        $isAdmin = Auth::user()->is_admin;

        return view('dashboard.video.videos', compact('videos', 'videoGroup', 'isAdmin'));
    }

    /**
     * Show a single video with user information
     */
    public function showVideo($courseid, $id)
    {
        // Validate that both course ID and video ID are provided
        if (!$courseid || !$id) {
            return redirect()->back()->with('error', 'Both course and video must be specified.');
        }

        try {
            // Get the video
            $video = Video::findOrFail($id);
            if ($video->is_active == 0) {
                return redirect()->back()->with('error', 'Video not found.');
            }

            // Get the current user ID
            $userId = Auth::id();

            // Find the video group this video belongs to
            // This validates that the video belongs to the specified course
            $videoGroup = VideoGroup::where('video_id', $id)
                ->where('video_group_id', $courseid)
                ->first();

            if (!$videoGroup) {
                return redirect()->back()->with('error', 'Video not found in the specified course.');
            }

            // Get all videos in this group for the video list
            $groupId = isset($videoGroup->videoGroup) ? $videoGroup->videoGroup->id : $videoGroup->video_group_id;

            $videos = Video::whereIn('id', function ($query) use ($groupId) {
                $query->select('video_id')
                    ->from('video_group')
                    ->where('video_group_id', $groupId);
            })->get();

            // Get user rating for this video if it exists
            $userRate = VideoCountView::where('video_id', $id)
                ->where('video_group_id', $courseid)
                ->where('userId', $userId)
                ->first();

            return view('dashboard.video.single-video', compact('video', 'videoGroup', 'videos', 'userId', 'userRate'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while retrieving the video.');
        }
    }
}
