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

    public function doctors()
    {
        return $this->belongsToMany(Admin::class, 'clinic_doctor', 'clinic_id', 'doctor_id');
    }

    public function appointments() {
        return $this->belongsToMany(Appointment::class, 'appointment_clinic');
    }

}
