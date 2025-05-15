<?php

namespace App\Services\Admin\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RoleServiceInterface
{
    public function givePermissionToRole(Model $model,array $data);

    // public function addPermissionToRole(Role $role, array $data);
}
