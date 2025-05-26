<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Timeslot;
use App\Models\Show;
use App\Models\Bookings;

use Carbon\Carbon;
class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date;
        $slot_id = $request->slot_id;
        $show_id = $request->show_id;
        $query = Bookings::with(['user','slot','show']);
        if (!empty($date)){
            $query->where('date',$date);
        }
        if (!empty($request->slot_id)){
            $query->where('timeslot_id',$slot_id);
        }
        if (!empty($request->show_id)){
            $query->where('show_id',$show_id);
        }
        
        $bookings = $query->where('status',1)->latest()->simplePaginate(5);

        $timeslots = Timeslot::where('is_active',1)->pluck('name', 'id');
        $show = Show::where('is_active',1)->pluck('name', 'id');
        return view('admin.bookings.search',compact('timeslots','show','bookings'));
    }
    

}
