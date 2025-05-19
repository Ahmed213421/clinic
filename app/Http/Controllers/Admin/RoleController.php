<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GivePermissionToRoleRequest;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\Interfaces\AdminRoleRepositoryInterface;
use App\Services\Admin\Interfaces\RoleServiceInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $adminroleRepository;
    protected $roleServiceInterface;
    public function __construct(AdminRoleRepositoryInterface $adminroleRepository, RoleServiceInterface $roleServiceInterface)
    {
        $this->adminroleRepository = $adminroleRepository;
        $this->roleServiceInterface = $roleServiceInterface;
        // $this->middleware('permission:view role', ['only' => ['index']]);
        // $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        // $this->middleware('permission:update role', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::get();
        return view('dashboard.role-permission.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('dashboard.role-permission.role.create');
    }

    public function store(RoleRequest $request)
    {

        try {
            DB::beginTransaction();
            $this->adminroleRepository->store($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to store role. Please try again later.');
        }
        return redirect()->route('admin.roles.index')->with('status', 'Role Created Successfully');
    }

    public function edit(Role $role)
    {
        return view('dashboard.role-permission.role.edit', [
            'role' => $role
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();
            $this->adminroleRepository->update($role, $request->validated());
            toastr()->success('Role updated successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to update role. Please try again later.');
        }
        return redirect()->route('admin.roles.index')->with('status', 'Role Updated Successfully');
    }

    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();
            $this->adminroleRepository->destroy($role);
            toastr()->success('Role deleted successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to delete role. Please try again later.');
        }
        return redirect()->route('admin.roles.index')->with('status', 'Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                ->all();

        return view('dashboard.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(GivePermissionToRoleRequest $request, Role $role)
    {


        try {
            DB::beginTransaction();
            $this->roleServiceInterface->givePermissionToRole($role, $request->validated());
            toastr()->success('Permissions Added To Role successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to delete role. Please try again later.');
        }
        return redirect()->back()->with('status', 'Permissions added to role');
    }
}
