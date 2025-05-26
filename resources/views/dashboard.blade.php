@extends('layouts.app')
@section('title', 'Dashboard')<!DOCTYPE html>
@section('content')
  <div class="row">
    <div class="col-sm">
     <a class="w-100 btn btn-primary" href="{{ route('booking.index') }}">Book Seats</a>
    </div>
  </div>
@endsection