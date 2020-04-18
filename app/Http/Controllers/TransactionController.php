<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;

use App\Wallet;

use App\Category;

use App\User;

use Auth;

class TransactionController extends Controller
{
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
        

        return redirect('/transaction/create');
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
    }
}
