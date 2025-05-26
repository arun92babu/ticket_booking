@extends('layouts.app')
@section('title', 'Shows')<!DOCTYPE html>
@section('content')

 <div class="plane">
  <div class="cockpit">
    <h1>Please select a seat</h1>
  </div>
  <div class="container">
    <div class="row">
    <span class="label label-primary" id="successMessage"></span>
    <span class="label label-danger" id="error"></span>
  </div>
  </div>
  <form action="{{ route('book') }}" method="POST" id="ajaxForm">
        @csrf
  <ol class="cabin fuselage">
    @php $k=1; @endphp
      @for ($i = 1; $i <= 2; $i++)
          <li class="row row--{{$i}}">
          <ol class="seats" type="A">
            @for ($j = 1; $j <= 6; $j++)
            
              <li class="seat">
                <input type="checkbox" name="slot"  value="{{$k}}" {{(in_array($k,$bookings))?'disabled':''}} id="{{$k}}"/>
                <label for="{{$k}}">{{$k}}</label>
              </li>
              @php $k++; @endphp
            @endfor
          </ol>
          </li>
      @endfor
    
    
  </ol>
  <div class="container">
    <div class="row">
    <button type="submit" class="btn btn-sm btn-primary">Proceed to Book</button>
    <input type="hidden" id="date_id" value="{{$date}}">
    <input type="hidden" id="slot_id" value="{{$slot_id}}">
    <input type="hidden" id="show_id" value="{{$show_id}}">
  </div>
</div>
  </form>
</div>

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#ajaxForm').on('submit', function(e) {
        e.preventDefault();

        var checkboxvalue= [];
        var date_id= $('#date_id').val();
        var slot_id= $('#slot_id').val();
        var show_id= $('#show_id').val();

        $("input:checkbox[name=slot]:checked").each(function(){
          checkboxvalue.push($(this).val());
        });
        $.ajax({
            url: "{{ route('submit') }}",
            type: "POST",
            data: {
                    "_token": "{{ csrf_token() }}",
                    "checkboxvalue" : checkboxvalue,
                    "date" : date_id,
                    "slot_id" : slot_id,
                    "show_id" : show_id,
                  },
            success: function(response) {
              if(response.success) {
                  $('#successMessage').html(response.message);
                  location.reload(true);
              } else {
                  // Server returned success but with error message
                  $('#error').html(response.message);
              }
                
                
            },
            error: function() {
              alert('something went wrong');
                //error
            }
        });
    });
});
</script>