<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = ['name'];
    use HasFactory;




    public function doctors(){
        return $this->hasMany(Admin::class)->whereHas('roles', function($q) {
            $q->where('name', 'doctor');
        });
    }
}
