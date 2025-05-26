<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $table = 'booking';
     protected $fillable = ['user_id', 'seat_id','timeslot_id','show_id','date','status','booked_date'];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function slot()
    {
        return $this->belongsTo(Timeslot::class,'timeslot_id');
    }
    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
