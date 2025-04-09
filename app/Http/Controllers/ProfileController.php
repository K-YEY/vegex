<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    private $_route_view_profile = 'dashboard.profile';
    private $_route_view_edit_profile = 'dashboard.auth.edit-profile';

    public function index(){
        return view($this->_route_view_profile, [
            'user' => Auth::user()
        ]);
    }
    public function edit()
    {
        return view($this->_route_view_edit_profile, [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email',    'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|vegex\.com)$/', 'max:255', 'unique:users,email,' . $user->id],
            'confirm_email' => ['required', 'string', 'email', 'same:email'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9]{7,15}$/', 'unique:users,phone,' . $user->id],
        ]);

        $emailChanged = $request->email !== $user->email;

        $user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($emailChanged) {
            $user->email_verified_at = null;
            $user->save();
            $user->sendEmailVerificationNotification();
        }

        return back()->with('status', 'profile updated');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->min(8)],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password updated');
    }
}
