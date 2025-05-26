@extends('layouts.app')
@section('title', 'Dashboard')<!DOCTYPE html>
@section('content')
<div class="container">
<form action="{{ route('book') }}" method="POST">
        @csrf
<div class="row">
  
  <div class="col-md-3">
    <input type="date" name="date" class="form-control" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
  </div>
  <div class="col-md-3">
    <select name="slot_id" class="form-control" required>
      <option value="">Select Slot</option>
      @foreach($timeslots as $id => $name)
          <option value="{{ $id }}" {{ old('slot_id') == $id ? 'selected' : '' }}>
              {{ $name }}
          </option>
      @endforeach
  </select>
  </div>
  <div class="col-md-3">
  <select name="show_id" class="form-control" required>
      <option value="">Select Show</option>
      @foreach($show as $id => $name)
          <option value="{{ $id }}" {{ old('show_id') == $id ? 'selected' : '' }}>
              {{ $name }}
          </option>
      @endforeach
  </select>

  </div>
<div class="col-md-3">
<button type="submit" class="btn btn-sm btn-primary">Search</button>
</div>
</div>

  </form>
</div>
 

@endsection
