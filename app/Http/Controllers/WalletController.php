<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateWallet;

use App\Http\Requests\EditWallet;

use App\Wallet;

use DB;

class WalletController extends Controller
{

    // Show view create wallet
    public function get_create(){
        return view('wallets.create');
    }
    /**
     * Store a newly created resource in storage
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post_create(CreateWallet $request){
        $wallet = new Wallet;
        $wallet->name = $request->input('name');
        $wallet->user_id = auth()->user()->id;
        $wallet->balance = 0;
        $wallet->save();
        return redirect()->route('wallet.list_wallet');
    }

    //show view of list wallets
    public function listWallet(){
        $lists = DB::table('wallets')->where('user_id',auth()->user()->id)->select()->get(); 
        // dd($lists);
        return view('wallets.list',['lists'=>$lists]);
    }

    /**
     * show view of edit wallet
     * @param $id
     */
    public function get_editWallet($id){
        $wallet = DB::table('wallets')->find($id);
        return view('wallets.edit',['wallet'=>$wallet]);
    }
    /**
     * change name of wallet
     * @param $id
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post_editWallet(EditWallet $request, $id){
        $wallet = Wallet::find($id);
        $wallet->name = $request->input('name');
        $wallet->save();
        return redirect()->route('wallet.list_wallet');
    }

    /**
     * Delete wallet 
     * @param $id
     */
    public function deleteWallet($id){
        $wallet = Wallet::find($id);
        $wallet->delete();
        return redirect()->route('wallet.list_wallet');
    }
}
