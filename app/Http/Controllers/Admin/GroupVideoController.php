<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class GroupVideoController extends Controller
{
    private $_route_view_create , $_route_view_edit , $_route_view ;
    public function __construct()
    {
        $this->_route_view = 'dashboard.admin.video.table.video-groups-table';
        $this->_route_view_create = 'dashboard.admin.video.video-group';
        $this->_route_view_edit = 'dashboard.admin.video.video-group';

    }

    public function index()
    {
        $groups = GroupVideo::latest()->paginate(10);
        return view($this->_route_view, compact('groups'));
    }

    public function create()
    {
        return view($this->_route_view_create, [
            'user' => Auth::user()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'max_videos' => 'required|integer|min:1',
            'max_users' => 'required|integer|min:1',
            'price' => 'required_unless:is_free,1|numeric|min:0|nullable',
            'discount' => 'nullable|numeric|min:0|lt:price',
            'desc' => 'required|string',
            'cover' => 'required|image|mimes:jpeg,png,gif|max:2048'
        ]);

        if ($request->is_free) {
            $request->merge(['price' => null, 'discount' => null]);
        }

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('group-covers', 'public');
        }

        $groupVideo = GroupVideo::create([
            'title' => $request->title,
            'description' => $request->desc,
            'max_videos' => $request->max_videos,
            'join_max' => $request->max_users,
            'price' => $request->is_free ? 0 : $request->price,
            'discount' => $request->discount,
            'cover' => $coverPath,
        ]);

        return redirect()->route('admin.video.groups')
            ->with('success', 'Video group created successfully');
    }

    public function edit(GroupVideo $groupVideo)
    {
        return view($this->_route_view_edit, compact('groupVideo'));
    }

    public function update(Request $request, GroupVideo $groupVideo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'max_videos' => 'required|integer|min:1',
            'max_users' => 'required|integer|min:1',
            'price' => 'required_if:is_free,0|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'desc' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,gif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            if ($groupVideo->cover) {
                Storage::disk('public')->delete($groupVideo->cover);
            }
            $coverPath = $request->file('cover')->store('group-covers', 'public');
            $groupVideo->cover = $coverPath;
        }

        $groupVideo->update([
            'title' => $request->title,
            'description' => $request->desc,
            'max_videos' => $request->max_videos,
            'join_max' => $request->max_users,
            'price' => $request->is_free ? 0 : $request->price,
            'discount' => $request->discount,
        ]);

        return redirect()->route('admin.video.groups')
            ->with('success', 'Video group updated successfully');
    }

    public function destroy(GroupVideo $groupVideo)
    {
        if ($groupVideo->cover) {
            Storage::disk('public')->delete($groupVideo->cover);
        }
        $groupVideo->delete();
        return redirect()->route('admin.video.groups')
            ->with('success', 'Video group deleted successfully');
    }
}
