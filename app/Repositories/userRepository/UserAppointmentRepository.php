<?php
namespace App\Repositories\userRepository;

use App\Models\UserAppointment;
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

        toastr()->success('user Appointment created successfully');
        return $appointment;

    }

    public function update($model, array $data)
    {
        $model->update($data);

        toastr()->success('user Appointment updated successfully');
        return $model;
    }

    public function destroy($model)
    {
        toastr()->success('Appointment deleted successfully');
        return $model->delete();
    }
}
