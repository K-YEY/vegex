<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('dashboard.sign-in');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|vegex\.com)$/'
            ],
            'password' => ['required', 'string'],
        ]);


        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'You have successfully logged in!');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
