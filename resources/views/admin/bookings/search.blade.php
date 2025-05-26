@extends('admin.layouts.app')
@section('title', 'Dashboard')<!DOCTYPE html>
@section('content')
<div class="container">
<form action="{{ route('admin.show.index') }}" method="GET">
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
  <table class="table table-striped">
  <thead>
    <tr>
      
      <th scope="col">User</th>
      <th scope="col">Cinema</th>
      <th scope="col">Date</th>
      <th scope="col">Seat No.</th>
    </tr>
  </thead>
  <tbody>
    @php $booked=0; @endphp
    @foreach($bookings as $key=>$data) 
    <tr>
      <td>{{ $data->user->name }}</td>
      <td>{{ $data->show->name }}</td>
      <td>{{ $data->date }}</td>
      <td>{{ $data->seat_id }}</td>
    </tr>
    @php $booked++; @endphp
    @endforeach
  </tbody>
</table>
{{ $bookings->links() }}
<div class="container">
  <div class="row">
    <h5>Total Seat : 12</h5>
    <h4>Total Booking : {{ $booked }}</h4>
    <h4>Balance : {{ 12-$booked }}</h4>
  </div>
</div>
</div>
 

@endsection
