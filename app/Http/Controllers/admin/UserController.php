<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showProfile(){
        // dd(Auth::user()->role);
        return view('backend.profile.index');
    }

    public function changePassword(Request $request){
        // dd($request->input());
        if (Hash::check($request->input('old_password'),  Auth::user()->password )){
            if ($request->input('new_password') == $request->input('re_new_password')){
                Auth::user()->update(['password' => $request->input('new_password')]);
                return 1;
            } else {
                return "Mật khẩu nhập lại không chính xác";
            }
        } else {
            return "Mật khẩu của bạn không chính xác";
        }
    }
}
