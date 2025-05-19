<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id','clinic_id','user_id', 'start_time', 'end_time', 'status','booked'];



    public function doctor(){
        return $this->belongsTo(Admin::class,'doctor_id');
    }


    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'clinic_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function userAppointment(){
        return $this->hasone(UserAppointment::class);
    }

}
