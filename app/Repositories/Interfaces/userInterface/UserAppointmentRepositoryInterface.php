<?php

namespace App\Repositories\Interfaces\userInterface;

interface UserAppointmentRepositoryInterface
{
    public function store(array $data);

    public function update(int $id,array $data);

    public function destroy(int $id);

}
