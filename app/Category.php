<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */

     protected $fillable = [
         'user_id','type','name','delete_flag',
     ];

     protected $table='categories';

     public function user(){
         return $this->belongsto('App\User');
     }

     public function transaction(){
         return $this->hasMany('App\Transaction');
     }
}
