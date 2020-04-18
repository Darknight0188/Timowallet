@extends('layouts.app')

@section('infomation')
<div class="container">
    <div class="card bg-light p-5 col-lg-8 offset-lg-2">
        <div class="card-header row">
            <div class="col-lg-2 p-0 d-flex justify-content-start">
                <a href="/cat" class="btn btn-success mt-auto mb-auto">Back</a>
            </div>
            <div class="col-lg-8 d-flex justify-content-center">
                <h5 class="font-weight-bold mt-auto mb-auto">{{ __('New Transaction') }}</h5>
            </div>
        </div>

        <div class="card-body">
        {!! Form::open(['method'=>'POST','action'=>'TransactionController@store']) !!} 

        <div class="form-group">
            {!! Form::label('wallet_id', 'Wallet:') !!}
            {!! Form::select('wallet_id',[''=>'Choose Wallet'] + $wallet,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
           <label name='category_id'>Category:</label>
           <select name="category_id" id="category_id">
                <optgroup label="Income">
                    @foreach($incomes as $income)
                        <option value="{{$income->id}}">{{$income->name}}</option>
                    @endforeach    
                </optgroup>
                <optgroup label="Outcome">
                    @foreach($outcomes as $outcome)
                        <option value="{{$outcome->id}}">{{$outcome->name}}</option>
                    @endforeach
                </optgroup>
           </select>
        </div>

        <div class="form-group">
            {!! Form::label('type', 'Type:') !!}
            {!! Form::select('type', array(0=>'Income',1=>'Outcome'), 0, ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('details', 'Detail:') !!}
            {!! Form::text('details',null,['class'=>'form-control'])!!}
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
        </div>
    </div>
</div>
@endsection