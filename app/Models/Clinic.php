<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function doctors() {
        return $this->belongsToMany(Doctor::class,'clinic_doctor');
    }
    public function appointments() {
        return $this->belongsToMany(Appointment::class, 'appointment_clinic');
    }

    public function USerAppointment(){
        return $this->belongsToMany(UserAppointment::class,'clinic_user');
    }
}
