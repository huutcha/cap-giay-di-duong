<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = ['active'];

    public function ward () {
        return $this->hasMany(Ward::class);
    }

    public function getActiveTextAttribute () {
        if ($this->active == 0){
            return "Chưa kích hoạt";
        }
        if ($this->active == 1){
            return "Đã kích hoạt";
        }
    }
}
