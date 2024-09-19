<?php

namespace App\Repositories\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Master\PermissionHasGroupName;
use Illuminate\Support\Facades\DB;

class RoleRepository
{
    public $request;
    public $groupName;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function save()
    {
        $role = Role::create([
            'name' => $this->request['name'],
        ]);

        $role->syncPermissions($this->request->get('permissions_id'));

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['message'] = 'Data created successfully!';
        $datas['data'] = $role->fresh();

        return $datas;
    }

    public function getAll()
    {
        $perPage = request('per_page', 10);

        DB::statement("SET SQL_MODE=''");

        $roles = DB::table('roles')
            ->selectRaw('
                roles.id,
                roles.name,
                roles.guard_name
            ')
            ->when(request('global'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->groupBy('roles.id')
            ->get();

        $roles = getPaginatedData($roles, $perPage);
        $roleIds = collect($roles->items())->pluck('id')->toArray();

        $permissions = DB::table('permissions')
            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->whereIn('role_has_permissions.role_id', $roleIds)
            ->select('permissions.*', 'role_has_permissions.role_id')
            ->get();

        foreach ($roles->items() as $role) {
            $role->permissions = $permissions->where('role_id', $role->id)->values()->toArray();
        }

        DB::statement("SET SQL_MODE=only_full_group_by");

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['roles'] = $roles;
        $datas['items_per_show'] = $perPage;

        return $datas;
    }

    public function showSingle($id)
    {
        $countPermissionHasGroupName = PermissionHasGroupName::count();
        $items = $this->request->items ?? $countPermissionHasGroupName;

        $this->groupName = PermissionHasGroupName::orderBy('id', 'asc')->paginate($items);
        $this->groupName->getCollection()->transform(function ($groupNameValue) use ($id) {
            $groupNameDatas = [];

            $countPermission = Permission::count();
            $itemsPermissions = $this->request->items ?? $countPermission;

            $groupNameDatas['id'] = $groupNameValue->id;
            $groupNameDatas['name'] = $groupNameValue->name;

            $permissions = Permission::where('group_name', $groupNameValue->id)->paginate($itemsPermissions);
            $permissions->getCollection()->transform(function ($permissionValue) use ($id) {
                $permissionDatas = [];

                $permissionDatas['permission'] = $permissionValue->name;

                if ($id > 0) {
                    $permissionIds = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)->get();
                    foreach ($permissionIds as $permissionId) {
                        if ($permissionId->permission_id == $permissionValue->id) {
                            $permissionDatas['assigned'] = true;
                        }
                    }
                }

                return $permissionDatas;
            });

            $groupNameDatas['permissions'] = $permissions;

            return $groupNameDatas;
        });

        if ($id === 0) {
            $datas = [];
            $datas['success'] = true;
            $datas['status'] = 200;
            $datas['group_name'] = $this->groupName;
            $datas['items_per_show'] = $items;

            return $datas;
        }
    }

    public function showById($id)
    {
        $items = $_GET['items'] ?? 10;
        $role = Role::orderBy('id', 'DESC')->where('id', $id)->first();

        $this->showSingle($id);

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['role'] = $role;
        $datas['group_name'] = $this->groupName;
        $datas['items_per_show'] = $items;

        return $datas;
    }

    public function getById($id)
    {
        $role = Role::where('id', $id)->get();

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['role'] = $role;

        return $datas;
    }

    public function edit($id)
    {
        $this->showSingle($id);

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['group_name'] = $this->groupName;

        return $datas;
    }

    public function update($id)
    {
        $role = Role::find($id);
        $role->name = $this->request->get('name');
        $role->save();

        $role->syncPermissions($this->request->get('permissions_id'));

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['message'] = 'Data updated successfully!';
        $datas['data'] = $role->fresh();

        return $datas;
    }

    public function softDeleteById($id)
    {
        $role = Role::findOrFail($id);

        if ($role) {
            $role->delete();

            $datas = [];
            $datas['success'] = true;
            $datas['status'] = 200;
            $datas['message'] = 'Data deleted successfully!';

            return $datas;
        }
    }

    public function getAbilities()
    {
        $abilities = request()->user()->getAllPermissions()->pluck('name');

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['data'] = $abilities;

        return $datas;
    }
}
