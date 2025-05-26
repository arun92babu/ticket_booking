@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
  <div class="row">
    <div class="col-sm">
     <a class="w-100 btn btn-primary" href="{{ route('admin.users.index') }}">Users</a>
    </div>
    <div class="col-sm">
     <a class="w-100 btn btn-primary" href="{{ route('admin.show.index') }}">Shows</a>
    </div>
  </div>
@endsection
