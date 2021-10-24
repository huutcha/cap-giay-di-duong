<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class AuthenticateController extends Controller
{
    public function loginForm(){
        if (Auth::check()){
            return redirect('/admin');
        }
        return view('backend.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ])){
            return redirect('/admin');
        } else {
            Session::flash('error', 'Username hoặc password không chính xác');
            return redirect('/admin/login');
        }
    }

    public function forgotPasswordForm () {
        return view('backend.auth.reset');
    }

    public function forgotPassword (Request $request) {
        $request->validate([
            'email' => 'bail|required|email|exists:accounts,email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function resetForm ($token, Request $request) {
        $email = $request->input('email');
        return view('backend.auth.reset-password', compact('token', 'email'));
    }

    public function reset (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                    
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout () {
        Auth::logout();
        return redirect('/admin/login');
    }
}
