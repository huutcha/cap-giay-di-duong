<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function showLogin(){
        return view('backend.auth.login');
    }
}
