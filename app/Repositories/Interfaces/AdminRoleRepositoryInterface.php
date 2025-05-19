<?php

namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model;

interface AdminRoleRepositoryInterface
{
    public function store(array $data);

    public function update(Model $model,array $data);

    public function destroy(Model $model);

}
