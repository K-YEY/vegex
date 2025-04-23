<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardConrtoller extends Controller
{

    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     *
     */
    private $_route_view;
    public function __construct()
    {
        $this->_route_view = 'admin.video.index';
    }
    public function index()
    {
        $data = [];
        if (Auth::user()->is_admin == 0) {
            $total_orders = Order::where('is_paid', true)->sum('total_price');
            $count_users = User::where('is_admin', true)->count();
            $count_videos = Video::where('is_active', true)->count();
            $data = [
                'total_orders' => $total_orders,
                'count_users' => $count_users,
                'count_videos' => $count_videos
            ];
        }
        return view($this->_route_view, $data);
    }
}
