<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['human_id', 'reason', 'reason_desc', 'organ_id', 'duration', 'email'];

    public function human () {
        return $this->belongsTo(Human::class,);
    }

    public function organ () {
        return $this->belongsTo(Organ::class,);
    }
    

}
