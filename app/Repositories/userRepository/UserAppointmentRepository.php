<?php

namespace App\Repositories\userRepository;

use App\Models\Admin;
use App\Models\User;
use App\Models\UserAppointment;
use App\Notifications\DoctorBookedNotification;
use App\Notifications\UserAppointmentStatusNotification;
use App\Repositories\Interfaces\userInterface\UserAppointmentRepositoryInterface;

class UserAppointmentRepository implements UserAppointmentRepositoryInterface
{
    protected $model;

    public function __construct(UserAppointment $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        $appointment = $this->model->create($data);

        $doctor = Admin::find($data['doctor_id']);

        $appointment->appointment->update(['booked' => true]);
        if ($doctor) {
            $doctor->notify(new DoctorBookedNotification($appointment));
        }


        return $appointment;

    }

    public function update($model, array $data)
    {
        $model->update($data);


        $doctor = Admin::find($model->doctor->id);
        if ($data['status'] == 'cancelled') {
            if (auth()->check()) {
                $model->cancelledBy()->associate(auth()->user());
                $model->save();
            }
            $model->appointment->update(['booked' => false]);

        } else {

            $model->appointment->update(['booked' => true]);
            $model->cancelled_by_id = null;
            $model->cancelled_by_type = null;
            $model->save();

        }
        if ($doctor) {
            $doctor->notify(new UserAppointmentStatusNotification($model));
        }



        return $model;
    }

    public function destroy($model)
    {

        $model->delete();

        $model->appointment->update(['booked' => false]);

        return $model;

    }
}
