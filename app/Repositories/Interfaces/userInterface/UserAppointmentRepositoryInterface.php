<?php

namespace App\Repositories\Interfaces\userInterface;
use Illuminate\Database\Eloquent\Model;

interface UserAppointmentRepositoryInterface
{
    public function store(array $data);

    public function update(Model $model,array $data);

    public function destroy(Model $model);

}
