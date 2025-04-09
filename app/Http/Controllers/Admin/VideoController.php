<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    private $_route_view = 'dashboard.admin.video';

    public function index() {}

    public function create()
    {
        return view($this->_route_view);
    }
    public function store() {}

    public function edit()
    {
        return view($this->_route_view);
    }
    public function update() {}

    public function destroy() {}
}
