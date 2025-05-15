<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ddoctor extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function clinics() {
    return $this->belongsToMany(Clinic::class,'clinic_doctor');
}
    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
