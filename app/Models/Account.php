<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['username', 'password', 'role', 'email'];

    public function human () {
        return $this->hasOne(Human::class);
    }

    public function getRoleTextAttribute () {
        if ($this->role == 0){
            return "Cán bộ thành phố";
        }
        if ($this->role == 1){
            return "Cán bộ quận, huyện";
        }
        if ($this->role == 2){
            return "Cán bộ phường, xã, thị trấn";
        }
    }

    public function getWorkUnitAttribute () {
        if ($this->role == 0){
            return "Thành phố Hà Nội";
        }
        if ($this->role == 1){
            return $this->human->ward->district->name;
        }
        if ($this->role == 2){
            return $this->human->ward->name;
        }
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    static function getAccountsByDistrict ($id) {
        $result = collect();
        foreach (static::all() as $account){
            if ($account->human->ward->district->id == $id && $account->role == 2) {
                $result->push($account);
            }
        }
        return $result;
    }

}
