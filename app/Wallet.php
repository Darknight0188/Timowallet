<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    protected $fillable = [
        'user_id','name','balance','delete_flag',
    ];

    public function users(){
        return $this->belongsto('App\User');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }
}
