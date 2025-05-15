<?php
namespace App\Repositories;

use App\Models\Clinic;
use App\Repositories\Interfaces\ClinicRepositoryInterface;

class ClinicRepository implements ClinicRepositoryInterface
{
    protected $model;

    public function __construct(Clinic $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        $clinic = $this->model->create($data);

        $clinic->doctors()->attach($data['doctor_id'] ?? []);
        $clinic->appointments()->attach($data['appointment_id'] ?? []);

        return $clinic;

    }

    public function update($model, array $data)
    {
        $model->update($data);
        $model->doctors()->sync($data['doctor_id']);
        $model->appointments()->sync($data['appointments_id']);

        return $model;
    }

    public function destroy($model)
    {

        return $model->delete();
    }
}
