<?php

namespace App\Repositories\Interfaces;

interface ClinicRepositoryInterface
{
    public function store(array $data);

    public function update(Model $model,array $data);

    public function destroy(Model $model);

}
