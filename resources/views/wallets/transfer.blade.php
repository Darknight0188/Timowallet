@extends('layouts.app')

@section('infomation')

    <h1>Transfer money</h1>
    <div class="card-body">
        {!! Form::open(['method'=>'POST']) !!} 

        <div class="form-group">
            {!! Form::label('wallet', 'Wallet:') !!}
            {!! Form::select('wallet',[''=>'Choose Wallet'] + $transfers,['class'=>'form-control'])!!}
        </div>
        
        <div class="form-group">
            {!! Form::label('amount', 'Amount:') !!}
            {!! Form::number('amount',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        </div>
        </div>    

        {!! Form::close() !!}    
@stop