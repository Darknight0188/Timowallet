@extends('layouts.app')

@section('infomation')

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Wallet</th>
      <th scope="col">Category</th>
      <th scope="col">Type</th>
      <th scope="col">Details</th>
      <th scope="col">Amount</th>
      <th scope="col">Created</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transactions as $transaction)
    <tr>
        <td>{{$transaction->id}}</td>
        <td>{{$transaction->users->name}}</td>
        <td>{{$transaction->wallet->name}}</td>
        <td>{{$transaction->category->name}}</td>
        <td>{{$transaction->type == 0 ? 'Income' : 'Outcome' }}</td>
        <td>{{$transaction->details}}</td>
        <td>{{$transaction->amount}}</td>
        <td>{{$transaction->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop