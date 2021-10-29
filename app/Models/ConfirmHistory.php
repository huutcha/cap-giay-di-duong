<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmHistory extends Model
{
    use HasFactory;
    protected $fillable = ['account_id', 'application_id', 'state'];

    public function account () {
        return $this->belongsTo(Account::class);
    }

    public function application () {
        return $this->belongsTo(Application::class);
    }
}
