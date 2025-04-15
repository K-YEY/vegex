<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Routes;

class EmailVerificationController extends Controller
{
    private $_route_view = Routes::$verifyEmailPage;

    public function notice(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/')->with('success', 'Your email is already verified.');
        }

        return view($this->_route_view);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->intended('/')->with('success', 'Your email is already verified.');;
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
