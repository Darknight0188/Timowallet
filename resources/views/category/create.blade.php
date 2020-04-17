@extends('layouts.app')

@section('infomation')
<div class="container">
    <div class="card bg-light p-5 col-lg-8 offset-lg-2">
        <div class="card-header row">
            <div class="col-lg-2 p-0 d-flex justify-content-start">
                <a href="/cat" class="btn btn-success mt-auto mb-auto">Back</a>
            </div>
            <div class="col-lg-8 d-flex justify-content-center">
                <h5 class="font-weight-bold mt-auto mb-auto">{{ __('New Category') }}</h5>
            </div>
        </div>

        <div class="card-body">
        {!! Form::open(['method'=>'POST','action'=>'CategoryController@store']) !!} 

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('type', 'Type:') !!}
            {!! Form::select('type', array(0=>'Income',1=>'Expense'), 0, ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>
        </div>    

        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection