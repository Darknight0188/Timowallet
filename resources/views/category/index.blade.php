@extends('layouts.app')

@section('infomation')
<div class="container">
    <div class="card bg-light p-5 col-lg-8 offset-lg-2">
        <div class="card-header row">
            <div class="col-lg-2 p-0 d-flex justify-content-start">
                <a href="/dashboard" class="btn btn-success mt-auto mb-auto">Back</a>
            </div>
            <div class="col-lg-8 d-flex justify-content-center">
                <h4 class="mt-auto mb-auto">Categories</h4>
            </div>
        </div>
        <div class="card-body">
            
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Type</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($cats as $cat)
      <tr>
        <td>{{$cat->id}}</td>
        <td>{{$cat->name}}</td>
        <td>{{$cat->type == 0 ? 'Income':'Expense'}}</td>
        <td>{{$cat->created_at->diffForHumans()}}</td>
        <td>{{$cat->updated_at->diffForHumans()}}</td>
        <td>
            <a type='submit' class='btn btn-info' href="{{url('/category/update')}}/{{$cat->id}}">Edit</a>
            <a type='submit' class='btn btn-danger' href="{{url('/category/delete')}}/{{$cat->id}}">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
        </div>
    </div>
</div>
@endsection