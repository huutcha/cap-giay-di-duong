<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create(){
        return view('frontend.application.step1');
    }
}
