<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\VerifyEmail;
use App\Models\Verify;
use App\Models\Human;
use App\Models\Organ;
use App\Models\Application;
use App\Mail\SendVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class ApplicationController extends Controller
{
    public function create(){
        $districts = District::all();
        return view('frontend.application.step1', compact('districts'));
    }

    public function sendVerifyEmail(Request $request){
        // dd($request->input('email'));
        $olds = VerifyEmail::where('email', $request->input('email'))->get();
        if ($olds){
            foreach ($olds as $old){
                $old->delete();
            } 
        }
        $token = Str::random(6);
        Mail::to($request->input('email'))->send(new SendVerifyEmail($token));
        VerifyEmail::create([
            'email' => $request->input('email'),
            'token' => $token,
        ]);
        return 1;
    }

    public function verifyEmail(Request $request){
        // dd($request->input());
        $result = VerifyEmail::where(['email' => $request->input('email'), 'token' => $request->input('token')])->get();
        if (count($result) == 1){
            return 1;
        } else {
            return 0;
        }
    }

    public function store (Request $request){
        $inputs = $request->input();
        $files = $request->file('proof-upload');
        // dd($files);
        if (count(Human::where('cccd', $inputs['cccd'])->get()) == 0){
            $human = Human::create($inputs);
        }
        $organ = Organ::create([
            'name' => $inputs['work-unit'],
            'ward_id' => $inputs['unit-place']
        ]);
        $inputs = array_merge($inputs, ['human_id' => $human->id, 'organ_id' => $organ->id]);
        Application::create($inputs);

        if ($files){
            foreach ($files as $file){
                if (Storage::disk('verifies')->missing($file->getClientOriginalName())) {
                    $file->storeAs('', $file->getClientOriginalName(), 'verifies');
                }
                Verify::create([
                    'path' => $file->getClientOriginalName(),
                    'human_id' => $human->id
                ]);
            }  
        }

        Session::flash('status', 1);
        return redirect('/');

    }
}
