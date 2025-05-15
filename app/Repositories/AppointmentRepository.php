<?php
namespace App\Repositories;

use App\Models\Appointment;
use App\Models\Clinic;
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

        $appointment->clinics()->attach($data['clinic_id'] ?? []);

        return $appointment;

    }

    public function update($model, array $data)
    {
        $model->update($data);
        $model->clinics()->sync($data['clinic_id']);
        toastr()->success('Appointment updated successfully');
        return $model;
    }

    public function destroy($model)
    {
        toastr()->success('Appointment deleted successfully');
        return $model->delete();
    }
}
