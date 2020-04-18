@extends('layouts.app')

@section('infomation')
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">User name</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter name" value="{{$user->name}}">
        @if($errors->has('name'))
        <span class="error-text" style='color:red'>
        {{$errors->first('name')}}
        </span>
        @endif
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="Enter email" value="{{$user->email}}">
        @if($errors->has('email'))
        <span class="error-text" style='color:red'>
        {{$errors->first('email')}}
        </span>
        @endif
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Phone</label>
    <input type="text" class="form-control" name="phone" id="exampleInputPassword1" placeholder="Enter phone number" value="{{$user->phone}}">
        @if($errors->has('phone'))
        <span class="error-text" style='color:red'>
        {{$errors->first('phone')}}
        </span>
        @endif
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Address</label>
    <input type="text" class="form-control" name="address" id="exampleInputPassword1" placeholder="Enter address" value="{{$user->address}}">
        @if($errors->has('address'))
        <span class="error-text" style='color:red'>
        {{$errors->first('address')}}
        </span>
        @endif
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Gender</label>
    <select name="gender" id="">
        <option value="Male" @if($user->gender == 'Male') {{"selected"}} @endif>Male</option>
        <option value="Female" @if($user->gender == 'Female') {{"selected"}} @endif>Female</option>
    </select>
        @if($errors->has('gender'))
        <span class="error-text" style='color:red'>
        {{$errors->first('gender')}}
        </span>
        @endif
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection