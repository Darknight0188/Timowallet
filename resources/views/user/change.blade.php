@extends('layouts.app')

@section('infomation')
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="">Old Password</label>
    <input type="password" class="form-control" name="oldPassword" id="" placeholder="Enter old password" value="{{$user->password}}">
        @if($errors->has('oldPassword'))
        <span class="error-text" style='color:red'>
        {{$errors->first('oldPassword')}}
        </span>
        @endif
  </div>
  <div class="form-group">
    <label for="">New Password</label>
    <input type="password" class="form-control" name="newPassword" id="" placeholder="Enter new password" value="">
        @if($errors->has('newPassword'))
        <span class="error-text" style='color:red'>
        {{$errors->first('newPassword')}}
        </span>
        @endif
  </div>
  <div class="form-group">
    <label for="">Confirm Password</label>
    <input type="password" class="form-control" name="confirmPassword" id="" placeholder="Enter confirm password" value="">
        @if($errors->has('confirmPassword'))
        <span class="error-text" style='color:red'>
        {{$errors->first('confirmPassword')}}
        </span>
        @endif
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection