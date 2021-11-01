<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConfirmHistory;
use Illuminate\Support\Facades\Auth;

class ConfirmHistoryController extends Controller
{
    public function index () {
        $histories = ConfirmHistory::loadConfirmHistoryByUser(Auth::user());
        // dd($histories);
        return view('backend.application.history',compact('histories'));
    }
}
