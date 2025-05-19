<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface AppointmentRepositoryInterface
{
    public function store(array $data);

    public function update(Model $model,array $data);

    public function destroy(Model $model);

    public function updateStatus($id,$status);
}
