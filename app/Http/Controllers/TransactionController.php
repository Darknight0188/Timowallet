<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repository\WalletEloquentRepository;

use App\Transaction;

use App\Wallet;

use App\Category;

use App\User;

use Auth;

class TransactionController extends Controller
{

    protected $walletRepo;

    public function __construct(WalletEloquentRepository $walletRepo){
        $this->walletRepo = $walletRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = Transaction::all();
        
        return view('transaction.index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $wallet = Wallet::pluck('name','id')->all();

        $incomes = Category::select('id','name')->where('type',0)->get();

        $outcomes = Category::select('id','name')->where('type',1)->get();

        return view('transaction.create',compact('wallet','incomes','outcomes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $data['user_id'] = auth()->user()->id;

        $amount = $request->amount;

        $type = $request->type;

        Transaction::create($data);

        $wallet = Wallet::findOrFail($request->wallet_id);

        switch($type){
            case 0:
                $wallet->balance = $wallet->balance + $amount;
                $wallet->save();
                break;
            case 1:
                if($wallet->balance>$amount){
                    $wallet->balance = $wallet->balance - $amount;
                    $wallet->save();
                } 
                else {
                    echo "<script type='text/javasciprt>alert('You have not enough money');</script>";
                }
                break;
        }
        

        return redirect('/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $transaction = Transaction::findOrFail($id);

        $wallet = Wallet::pluck('name','id')->all();

        $incomes = Category::select('id','name')->where('type',0)->get();

        $outcomes = Category::select('id','name')->where('type',1)->get();

        return view('transaction.edit', compact('transaction','wallet','incomes','outcomes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       $transaction = Transaction::findOrFail($id);
       $old_wallet = $transaction->wallet_id;
       $old_type = $transaction->type;
       $old_amount = $transaction->amount;

       $this->transactionRollback($old_wallet, $old_type, $old_amount);

        $data = $request->all();
        $new_wallet = $data['wallet_id'];
        $new_type = $data['type'];
        $new_amount = $data['amount'];

        $this->updateWallet($new_wallet, $new_type, $new_amount);

        $transaction->update($id, $data);

        return redirect('/transaction');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect('/transaction');
    }

    public function search(Request $request){

    }

    public function transactionRollback($id, $type, $amount){
        $wallet = $this->walletRepo->find($id);
        switch($type) {
            case 0:
                $wallet->balance -= $amount;
                break;
            case 1:
                $wallet->balance += $amount;
                break;    
        }
        $wallet->save();
    }

    public function updateWallet($id, $type, $amount){
        $wallet = $this->walletRepo->find($id);
        switch ($type) {
            case 0:
                $wallet->balance += $amount;
                break;
            case 1:
                $wallet->balance -= $amount;
                break;    
        }
        $wallet->save();
    }
}
