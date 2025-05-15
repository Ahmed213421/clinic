<?php
namespace App\Repositories;

use App\Models\Doctor;
use App\Repositories\Interfaces\ClinicRepositoryInterface;
use App\Repositories\Interfaces\DoctorRepositoryInterface;

class DoctorRepository implements DoctorRepositoryInterface
{
    protected $model;

    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        $clinic = $this->model->create($data);

        $clinic->clinics()->attach($data['clinic_id'] ?? []);
        toastr()->success('Doctor created successfully');
        return $clinic;

    }

    public function update($model, array $data)
    {
        $model->update($data);
        $model->clinics()->sync($data['clinic_id']);
        toastr()->success('doctor updated successfully');
        return $model;
    }

    public function destroy($model)
    {
        toastr()->success('doctor deleted successfully');
        return $model->delete();
    }
}
