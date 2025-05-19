<?php

namespace App\Repositories\Interfaces;

interface DoctorRepositoryInterface
{
    public function update(Model $model,array $data);

    public function destroy(Model $model);

    public function store(array $data);

}
