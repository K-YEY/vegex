<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Routes;

class RegisterController extends Controller
{
    private $_route_view ;
    public function __construct()
    {
        $this->_route_view = 'dashboard.auth.sign-up';
    }
    public function create()
    {
        return view($this->_route_view);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|vegex\.com)$/'
            ],
            'phone' => [
                'required',
                'string',
                'unique:users',
                'regex:/^\+?[0-9]{7,15}$/'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ], [
            'name.required' => 'The name field is required.',
            'email.regex' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'phone.regex' => 'The phone number must be a valid number.',
            'phone.unique' => 'The phone number has already been taken.',
            'password.confirmed' => 'Must be same as password.',
            'password.regex' => 'The password must be at least 8 characters and contain at least one uppercase letter, one number, and one special character.',
        ]);

        $user = User::create([
            'name' => $request->fname.' '.$request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect('/');
    }
}
