<?php

namespace App\Repositories\Interfaces;

interface AdminRoleRepositoryInterface
{
    public function store(array $data);

    public function update(Model $model,array $data);

    public function destroy(Model $model);

}
