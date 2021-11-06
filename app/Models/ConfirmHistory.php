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

    static function loadConfirmHistoryByUser (Account $user){
        if ($user->role == 2){
            $ward = $user->human->ward;
            $humansByWard = $ward->human->whereNotNull("account_id");
            $history = collect();
            foreach($humansByWard as $humanByWard){
                $history = $history->merge($humanByWard->account->confirmHistory);
            }
            return $history;
        }
        if ($user->role == 0){
            return static::all();
        }
        if ($user->role == 1){
            $district = $user->human->ward->district;
            $humansByDistrict = collect();
            foreach ($district->ward as $ward){
                $humansByWard = $ward->human->whereNotNull("account_id");
                $humansByDistrict = $humansByDistrict->merge($humansByWard);
            }
            
            $history = collect();
            foreach($humansByDistrict as $humanByDistrict){
                $history = $history->merge($humanByDistrict->account->confirmHistory);
            }
            return $history;
        }
        
    }

    public function getStateTextAttribute(){
        if($this->state == 'accept'){
            return 'Chấp thuận';
        }
        if($this->state == 'cancel'){
            return 'Từ chối';
        }
    }
}
