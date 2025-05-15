<?php

namespace App\Services\Admin;

use App\Services\Admin\Interfaces\RoleServiceInterface;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService implements RoleServiceInterface
{
    protected $model;
    public function __construct(Role $model){
        $this->model = $model;
    }
    /**
     * Store a new role and return it.
     *
     * @param array $data
     * @return \App\Models\Role
     */
    public function addPermissionToRole($id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
    }

    /**
     * Update a role's information.
     *
     * @param \App\Models\Role $role
     * @param array $data
     * @return \App\Models\Role
     */
    public function givePermissionToRole($model,array $data)
    {
        $role = Role::where('id', $model)->where('guard_name', 'admin')->firstOrFail();
        return $role->syncPermissions($data['permission']);

    }
}
