<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateWallet;

use App\Http\Requests\EditWallet;

use App\Repository\WalletEloquentRepository;

use App\Wallet;

class WalletController extends Controller
{

    protected $walletRepo;

    public function __construct(WalletEloquentRepository $walletRepo){
        $this->walletRepo = $walletRepo;
    }

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
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['balance'] = 0;
        $this->walletRepo->create($data);
        return redirect()->route('wallet.list_wallet');
    }

    //show view of list wallets
    public function listWallet(){
        $lists = $this->walletRepo->getAll();
        // dd($lists);
        return view('wallets.list',['lists'=>$lists]);
    }

    /**
     * show view of edit wallet
     * @param $id
     */
    public function get_editWallet($id){
        $wallet = $this->walletRepo->find($id);
        return view('wallets.edit',['wallet'=>$wallet]);
    }
    /**
     * change name of wallet
     * @param $id
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post_editWallet(EditWallet $request, $id){
        $data = $request->all();
        $this->walletRepo->update($id,$data);
        return redirect()->route('wallet.list_wallet');
    }

    /**
     * Delete wallet 
     * @param $id
     */
    public function deleteWallet($id){
        $this->walletRepo->delete($id);
        return redirect()->route('wallet.list_wallet');
    }

    public function getTransfer($id){
        $wallet = $this->walletRepo->find($id);
        $transfers = Wallet::pluck('name','id')->except($wallet->id)->all();
        return view('wallets.transfer',compact('transfers'));
    }

    public function postTransfer(Request $request, $id){
        $wallet = $this->walletRepo->find($id);
        $transfer = $this->walletRepo->find($request->wallet);
        if($wallet->balance>=$request->amount){
            $total = $wallet->balance-$request->amount;
        } else {
            echo "<script type='text/javasciprt>alert('You have not enough money');</script>";
        }
        $wallet->balance = $total;
        $wallet->save();
        $transfer->balance = $request->amount+$transfer->balance;
        $transfer->save();
        return redirect()->route('wallet.list_wallet');
    }
}
