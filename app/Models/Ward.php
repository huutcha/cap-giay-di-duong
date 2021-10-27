<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $fillable = ['active'];

    public function district () {
        return $this->belongsTo(District::class);
    }

    public function human () {
        return $this->hasMany(Human::class);
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
