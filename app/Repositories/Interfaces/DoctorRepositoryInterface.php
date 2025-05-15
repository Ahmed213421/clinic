<?php

namespace App\Repositories\Interfaces;

interface DoctorRepositoryInterface
{
    public function store(array $data);

    public function update(int $id,array $data);

    public function destroy(int $id);

}
