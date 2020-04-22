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
        'category_id',
        'type',
        'details',
        'amount',
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
