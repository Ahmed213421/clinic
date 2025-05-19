<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Models\Clinic;
use App\Repositories\Interfaces\AdminRoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class AdminRoleRepository implements AdminRoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $model)
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
        $model->clinics()->sync($data['clinic_id']);

        return $model;
    }

    public function destroy($model)
    {
        $model->delete();
        return $model->delete();
    }

}
