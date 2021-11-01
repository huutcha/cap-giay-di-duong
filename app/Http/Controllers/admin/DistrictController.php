<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    public function update (Request $request) {
        $district = District::find($request->input('id'));
        if ($request->input('action') == 'active'){
            $district->update(['active' => 1]);
        }

        if ($request->input('action') == 'unactive'){
            $district->update(['active' => 0]);
            foreach ($district->ward as $ward){
                $ward->update(['active' => 0]);
            }
        }
        
        return 1;
    }
}
