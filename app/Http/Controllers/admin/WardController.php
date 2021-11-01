<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Ward;

class WardController extends Controller
{
    public function index ($id) {
        $district = District::find($id);
        $wards = $district->ward;
        // dd($wards);
        return json_encode($wards);
    }

    public function update (Request $request) {
        $ward = Ward::find($request->input('id'));
        if ($request->input('action') == 'active'){
            $ward->update(['active' => 1]);
        }
        
        if ($request->input('action') == 'unactive'){
            $ward->update(['active' => 0]);
        }
        
        return 1;
    }
    public function activeAll ($id) {
        $district = District::find($id);
        foreach ($district->ward as $ward){
            $ward->update(['active' => 1]);
        }
        return 1;
    }
}
