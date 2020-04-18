<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'user_id',
        'wallet_id',
        'cat_id',
        'type',
        'details',
        'amount',
        'benefit_wallet'
    ];

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }

    public function wallet(){
        return $this->belongsTo('App\Wallet');
    }

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
}
