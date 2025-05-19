<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAppointment extends Model
{

    protected $guarded = [];
    use HasFactory;

    protected $table = 'user_appointments';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function doctor(){
        return $this->belongsTo(Admin::class,'doctor_id');
    }
    public function clinic(){
        return $this->belongsTo(Clinic::class,'clinic_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class,'appointment_id');
    }

    public function cancelledBy()
    {
        return $this->morphTo();
    }
}
