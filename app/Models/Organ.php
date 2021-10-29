<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'ward_id'];

    public function ward () {
        return $this->belongsTo(Ward::class);
    }

    public function application () {
        return $this->hasMany(Application::class);
    }

    public function getFullAddressAttribute () {
        return $this->ward->name.', '.$this->ward->district->name.', Thành phố Hà Nội';
    }

}
