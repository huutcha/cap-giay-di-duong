<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'human_id'];

    public function human() {
        return $this->belongsTo(Human::class);
    }
}
