<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GroupVideo;
use App\Models\Video;
use App\Models\VideoGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoGroupController extends Controller
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
        })->get();

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
        })->get();

        // Check if the current user is an admin
        $isAdmin = Auth::user()->is_admin;

        return view('dashboard.video.videos', compact('videos', 'videoGroup', 'isAdmin'));
    }

    /**
     * Show a single video with user information
     */
    public function showVideo($id, $courseid)
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

            if (!$groupVideoId) {
                return back()->with('status', 'Course not found');
            }

            $groupVideo = GroupVideo::findOrFail($groupVideoId);

            // Create a temporary VideoGroup object
            $videoGroup = new VideoGroup();
            $videoGroup->videoGroup = $groupVideo;
        }

        // Get all videos in this group for the video list
        $groupId = isset($videoGroup->videoGroup) ? $videoGroup->videoGroup->id : $videoGroup->video_group_id;

        $videos = Video::whereIn('id', function ($query) use ($groupId) {
            $query->select('video_id')
                ->from('video_group')
                ->where('video_group_id', $groupId);
        })->get();

        return view('dashboard.video.single-video', compact('video', 'videoGroup', 'videos', 'userId'));
    }
}
