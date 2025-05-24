<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::where('is_admin', 0)->get();
        return view('dashboard.admin.users.users', compact('users'));
    }
}
