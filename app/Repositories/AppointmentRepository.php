<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\User;
use App\Models\UserAppointment;
use App\Notifications\DoctorAppointmentStatusNotification;
use App\Notifications\UserAppointmentStatusNotification;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use App\Repositories\Interfaces\ClinicRepositoryInterface;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    protected $model;

    public function __construct(Appointment $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        $appointment = $this->model->create($data);


        return $appointment;

    }

    public function update($model, array $data)
    {
        $model->update($data);

        // dd($this->model);


        return $model;
    }

    public function updateStatus($id, $status)
    {
        $user_appointment = UserAppointment::findOrFail($id);

        if ($status === 'cancelled') {
            $user_appointment->status = $status;
            $user_appointment->cancelledBy()->associate(auth('admin')->user());
            $user_appointment->save();
        } else {
            $user_appointment->status = $status;

            $user_appointment->cancelled_by_id = null;
            $user_appointment->cancelled_by_type = null;

            $user_appointment->save();
        }

        $patient = User::find($user_appointment->user_id);
        // dd($patient);
        if ($patient) {
            $patient->notify(new DoctorAppointmentStatusNotification($user_appointment));
        }

        return response()->json(['message' => 'Status updated successfully']);
    }


    public function destroy($model)
    {

        return $model->delete();
    }
}
