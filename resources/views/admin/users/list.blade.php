@extends('admin.layouts.app')
@section('title', 'Users List')
@section('content')
  <div class="row">
        <a class="nav-link" href="{{ url()->previous() }}">Back</a>
    <table class="table table-striped">
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $key=>$user)
    <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
  </div>
@endsection
