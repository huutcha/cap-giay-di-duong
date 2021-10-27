<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;
use App\Models\District;
use App\Models\Human;
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

    public function index () {
        if (Auth::user()->role == 0){
            $users = Account::all();
            $users = $users->diff(Account::where('id', 1)->get());
        }
        if (Auth::user()->role == 1){
            $id = Auth::user()->human->ward->district->id;
            $users = Account::getAccountsByDistrict($id);
        }
        $countUserByDistrict = count(Account::where('role', 1)->get());
        $countUserByWard = count(Account::where('role', 2)->get());
        return view('backend.users.index', compact('users', 'countUserByDistrict', 'countUserByWard'));
    }

    public function create () {
        if (Auth::user()->role == 0){
            $users = Account::all();
        }
        if (Auth::user()->role == 1){
            $id = Auth::user()->human->ward->district->id;
            $users = Account::getAccountsByDistrict($id);
        }
        $districts = District::all();
        return view('backend.users.create', compact('districts'));
    }

    public function checkUserExisted(Request $request){
        
        if (count(Account::where('username','=' ,$request->input('username'))->get())){
            return 0;
        } else {
            return 1;
        }
    }

    public function store(Request $request){
        $inputs = $request->input();
        $file = $request->file('avatar');
        // dd($file->getClientOriginalName());
        $user = Account::create($inputs);
        $inputs = array_merge($inputs, ['account_id' => $user->id]);
        if ($file){
            if (Storage::disk('avatars')->missing($file->getClientOriginalName())) {
                $file->storeAs('', $file->getClientOriginalName(), 'avatars');
            }
            $inputs = array_merge($inputs, ['avatar' => $file->getClientOriginalName()]);
        }
        // dd($inputs);
        $human = Human::create($inputs);
        return redirect('/admin/users');
    }

    public function edit($id){
        $user = Account::find($id);
        $districts = District::all();
        return view('backend.users.edit', compact('user', 'districts'));
    }

    public function update($id, Request $request){
        $user = Account::find($id);
        $user->update($request->input());
        $user->human->update($request->input());
        // dd($request->input());
        $file = $request->file('avatar');
        if ($file){
            if (Storage::disk('avatars')->exists($user->human->avatar)) {
                Storage::disk('avatars')->delete($user->human->avatar);
            }
            $file->storeAs('', $file->getClientOriginalName(), 'avatars');
            $user->human->update(['avatar' => $file->getClientOriginalName()]);
        }
        
        return redirect('/admin/users');
    }

    public function destroy (Request $request){
        $user = Account::find($request->input('id'));
        $user->delete();
        return 1;
    }
}
