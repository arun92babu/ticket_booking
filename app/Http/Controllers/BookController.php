<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Timeslot;
use App\Models\Show;
use App\Models\Bookings;

use Carbon\Carbon;
class BookController extends Controller
{
    public function index()
    {

        $timeslots = Timeslot::where('is_active',1)->pluck('name', 'id');
        $show = Show::where('is_active',1)->pluck('name', 'id');
        return view('booking.search',compact('timeslots','show'));
    }
    public function book(Request $request)
    {   
        $date = $request->date;
        $slot_id = $request->slot_id;
        $show_id = $request->show_id;
        $bookings = Bookings::where(['date'=>$date,'timeslot_id'=>$slot_id,'show_id'=>$show_id,'status'=>1])->pluck('seat_id')->toArray();
        return view('booking.list',compact('bookings','date','slot_id','show_id'));
    }
     public function submit(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        if($request->checkboxvalue){
            foreach ($request->checkboxvalue as $key => $value) {
                $book = new Bookings();
                $book->user_id = $userId;
                $book->seat_id = $value;
                $book->timeslot_id = $request->slot_id;
                $book->show_id = $request->show_id;
                $book->date = $request->date;
                $book->status = 1;
                $book->booked_date = $today;
                $book->save();
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Seat Booked successfully!'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Please select a Seat'
            ]);
        }
        
        
    }

}
