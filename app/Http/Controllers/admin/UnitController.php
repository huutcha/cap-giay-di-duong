<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function index () {
        if (Auth::user()->role == 0){
            $districts = District::all();
            $countDistrictActive = count(District::where('active', '=', 1)->get());
            $countDistrict = count($districts);
            $countWardActive = count(Ward::where('active', '=', 1)->get());
            $countWard = count(Ward::all());
            return view('backend.unit.city', compact('districts', 'countDistrictActive', 'countDistrict', 'countWardActive', 'countWard'));
        }

        if (Auth::user()->role == 1){
            $wards = Auth::user()->human->ward->district->ward;
            $countWardActive = count($wards->where('active', 1));
            $countWard = count($wards);
            return view('backend.unit.district', compact('wards','countWardActive', 'countWard'));
        }
    }
}
