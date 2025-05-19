<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Repositories\Interfaces\ClinicRepositoryInterface;
use App\Repositories\Interfaces\DoctorRepositoryInterface;
use Spatie\Permission\Models\Role;

class DoctorRepository implements DoctorRepositoryInterface
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        $doctor = $this->model->create($data);
        $doctor->clinics()->attach($data['clinic_id']);
        $doctorRole = Role::firstOrCreate(['name' => 'doctor', 'guard_name' => 'admin']);
        $doctor->assignRole($doctorRole);
        return $doctor;
    }

    public function update($id, array $data)
    {
        $doctor = Admin::find($id);
        $doctor->update($data);
        $doctor->clinics()->sync($data['clinic_id']);
        Appointment::find($data['appointment_id'])->update(['doctor_id',$doctor->id]);
        return $doctor;
    }

    public function destroy($id)
    {
        return Admin::find($id)->delete();

    }
}
