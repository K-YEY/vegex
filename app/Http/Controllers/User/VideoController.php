<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    private $_route_view = 'admin.video.index';
    public function index(){
        return view($this->_route_view);
    }

    public function create(){}
    public function store() {}

    public function edit(){}
    public function update() {}

    public function destroy() {}
}
