@extends('layouts.app')

@section('infomation')
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Name</th>
      <th scope="col">Balance</th>
      <th scope="col">Action</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      {{$stt = 1}}
      @foreach($lists as $list)
    <tr>
      <th scope="row">{{$stt++}}</th>
      <td>{{$list->name}}</td>
      <td>{{$list->balance}}</td>
        <td>
            <a href="{{url('wallet/edit')}}/{{$list->id}}" type="button" class="btn btn-primary">Edit</a>
            <a href="{{url('wallet/delete')}}/{{$list->id}}" type="button" class="btn btn-danger">Delete</a>
        </td>
        <td>
          <a href="{{url('wallet/transfer')}}/{{$list->id}}" type="button" class="btn btn-info">Transfer money</a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection