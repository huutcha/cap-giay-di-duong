<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Human extends Model
{
    use HasFactory;
    protected $fillable = ['fname', 'lname', 'cccd', 'phone', 'gender', 'dob', 'hometown', 'address', 'account_id', 'ward_id'];

    public function account () {
        return $this->belongsTo(Account::class);
    }

    public function ward () {
        return $this->belongsTo(Ward::class);
    }

    public function verify () {
        return $this->hasMany(Verify::class, 'human_id');
    }

    public function application () {
        return $this->hasMany(Application::class);
    }

    public function getFullNameAttribute () {
        return $this->fname.' '.$this->lname;
    }

    public function getFullAddressAttribute () {
        return $this->address.', '.$this->ward->name.', '.$this->ward->district->name.', Thành phố Hà Nội';
    }

}
