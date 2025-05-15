<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'specialization_id',
        'last_name',
        'phone_number',
        'email',
    ];

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class,'clinic_doctor');
    }


    public function specialization(){
        return $this->belongsTo(Specialization::class,'specialization_id');
    }
}
