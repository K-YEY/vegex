<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupVideo;
use App\Models\Video;
use App\Models\VideoGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    private $_route_view;

    public function __construct()
    {
        $this->_route_view = 'dashboard.admin.video.video';
    }

    public function index()
    {
        $videos = Video::all();
        return view('dashboard.admin.video.table.videos-table', compact('videos'));
    }

    public function create()
    {
        $groupVideos = GroupVideo::all();
        return view($this->_route_view, compact('groupVideos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_file' => 'required|mimes:mp4,mov,avi,wmv|max:102400',
            'group_video_id' => 'required|exists:group_videos,id',
            'is_active' => 'nullable',
            'is_free' => 'nullable'
        ]);

        try {
            DB::beginTransaction();

            // Handle cover file upload
            $coverPath = null;
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('videos/covers', 'public');
            }

            // Handle video file upload
            $videoPath = $request->file('video_file')->store('videos', 'public');

            // Create video record
            $video = Video::create([
                'title' => $request->title,
                'description' => $request->description,
                'video_path' => $videoPath,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'is_free' => $request->has('is_free') ? 1 : 0,
                'cover' => $coverPath,
                'count_view' => 0
            ]);

            // Create video group relationship
            VideoGroup::create([
                'video_group_id' => $request->group_video_id,
                'video_id' => $video->id
            ]);

            DB::commit();

            return redirect()->route('admin.videos')->with('success', 'Video created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating video: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $groupVideos = GroupVideo::all();
        $videoGroup = VideoGroup::where('video_id', $id)->first();

        return view($this->_route_view, compact('video', 'groupVideos', 'videoGroup'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_file' => 'nullable|mimes:mp4,mov,avi,wmv|max:102400',
            'group_video_id' => 'required|exists:group_videos,id',
            'is_active' => 'nullable',
            'is_free' => 'nullable'
        ]);

        try {
            DB::beginTransaction();

            $video = Video::findOrFail($id);

            // Handle cover file upload
            if ($request->hasFile('cover')) {
                // Delete old cover if exists
                if ($video->cover) {
                    Storage::disk('public')->delete($video->cover);
                }
                $coverPath = $request->file('cover')->store('videos/covers', 'public');
                $video->cover = $coverPath;
            }

            // Handle video file upload
            if ($request->hasFile('video_file')) {
                // Delete old video if exists
                if ($video->video_path) {
                    Storage::disk('public')->delete($video->video_path);
                }
                $videoPath = $request->file('video_file')->store('videos', 'public');
                $video->video_path = $videoPath;
            }

            // Update video record
            $video->title = $request->title;
            $video->description = $request->description;
            $video->is_active = $request->has('is_active') ? 1 : 0;
            $video->is_free = $request->has('is_free') ? 1 : 0;
            $video->save();

            // Update video group relationship
            $videoGroup = VideoGroup::where('video_id', $id)->first();
            if ($videoGroup) {
                $videoGroup->video_group_id = $request->group_video_id;
                $videoGroup->save();
            } else {
                VideoGroup::create([
                    'video_group_id' => $request->group_video_id,
                    'video_id' => $id
                ]);
            }

            DB::commit();

            return redirect()->route('admin.videos')->with('success', 'Video updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating video: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $video = Video::findOrFail($id);

            // Delete video file
            if ($video->video_path) {
                Storage::disk('public')->delete($video->video_path);
            }

            // Delete cover file
            if ($video->cover) {
                Storage::disk('public')->delete($video->cover);
            }

            // Delete video and its relationships
            $video->delete();

            return redirect()->route('admin.videos')->with('success', 'Video deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting video: ' . $e->getMessage());
        }
    }
}
