<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::middleware('verified')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix'=>'user','as'=>'user.','middleware'=>'auth'], function(){
        Route::get('/update/{id}','userController@getUpdate')->name('edit');
        Route::post('/update/{id}','userController@postUpdate')->name('postUser_update');
        Route::get('/change/{id}','userController@getChange')->name('change_Password');
        Route::post('/change/{id}','userController@postChange')->name('post_Password');
    });
    Route::group(['prefix'=>'wallet','as'=>'wallet.','middleware'=>'auth'], function(){
        Route::get('/create','WalletController@get_create')->name('create_wallet');
        Route::post('/create','WalletController@post_create')->name('post_wallet');
        Route::get('/list','WalletController@listWallet')->name('list_wallet');
        Route::get('/edit/{id}','WalletController@get_editWallet')->name('edit_wallet');
        Route::post('/edit/{id}',"WalletController@post_editWallet")->name('post_editWallet');
        Route::get('/delete/{id}',"WalletController@deleteWallet")->name('delete_wallet');
    });

});

