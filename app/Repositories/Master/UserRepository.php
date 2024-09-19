<?php

namespace App\Repositories\Master;

use App\Http\Requests\API\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Support\Facades\Validator;

class UserRepository
{
    protected $user;
    public $request;

    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function save(UserStoreRequest $request)
    {
        $user = User::create($request->validated());

        $user->assignRole($this->request->get('role_id'));

        return $user->fresh();
    }

    public function getAll()
    {
        $items = request('per_page', 10);
        $currentPage = request('page', 1);

        DB::statement("SET SQL_MODE=''");

        $queryUsers = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->selectRaw('
               users.id,
               roles.id as role_id,
               users.username,
               users.name,
               users.is_active,
               roles.name as role_name
           ')
            ->when($this->request->global, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('users.username', 'like', '%' . $search . '%')
                        ->orWhere('users.name', 'like', '%' . $search . '%')
                        ->orWhere('roles.name', 'like', '%' . $search . '%');
                });
            })
            ->when($this->request->role_id, function ($query, $role_id) {
                $query->where('roles.id', $role_id);
            })
            ->groupBy('users.id');

        $totalRecords = User::count();
        $trashedUser = User::onlyTrashed()->count();

        $users = $queryUsers->forPage($currentPage, $items)->get();
        $paginatedUsers = paginateData(collect($users), $items, $totalRecords, $currentPage);

        DB::statement("SET SQL_MODE=only_full_group_by");

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['users'] = $paginatedUsers;
        $datas['trashed_users'] = $trashedUser;
        $datas['items_per_show'] = $items;

        return $datas;
    }

    public function getById($id)
    {
        $user = User::where('id', $id)->get();
        $userData = $user->map(function ($value, $key) {
            $datas = [];

            $role = DB::table('model_has_roles')->where('model_id', $value->id)->exists();

            if ($role) {
                $roleId = DB::table('model_has_roles')->where('model_id', $value->id)->pluck('role_id');
                $role = Role::where('id', $roleId)->first();
            }

            $datas['id'] = $value->id;
            $datas['username'] = $value->username;
            $datas['name'] = $value->name;
            $datas['is_active'] = $value->is_active;
            if ($role) {
                $datas['role'] = $role;
            } else {
                $datas['role'] = null;
            }

            return $datas;
        });

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['user'] = $userData[0];

        return $datas;
    }

    public function showMe()
    {
        $auth = request()->user();

        $user = [];
        $user['username']   = $auth->username;
        $user['name']       = $auth->name;
        $user['role']       = $auth->roles->pluck('name')[0] ?? '';
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (request()->user()->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        $user['permission'] = $permissions;

        return $user;
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        if ($request['password'] !== null || $request['password'] === '') {
            $user->update($request->validated());
            Validator::make($request->only('password'), [
                'password' => [
                    'required', 'string',
                    'min:5',
                    // 'regex:/[a-z]/',      // must contain at least one lowercase letter
                    // 'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    // 'regex:/[0-9]/',      // must contain at least one digit
                ]
            ])->validate();

            $user->forceFill([
                'password' => $request['password'],
            ])->save();
        } else {
            $request->offsetUnset('password');
            $user->update($request->validated());
        }

        $isUserHasRole = DB::table('model_has_roles')->where('model_id', $user->id);
        if ($isUserHasRole->exists()) {
            $isUserHasRole->delete();
        }

        $user->assignRole($this->request->get('role_id'));

        return $user;
    }

    public function softDeleteById($id)
    {
        $user = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->selectRaw('
                users.id,
                roles.id as role_id,
                users.username,
                users.name,
                users.is_active,
                roles.name as role_name
            ');

        if (
            $user->first()->role_name == 'SUPERADMIN' &&
            checkRole()->role_name != Role::SUPERADMIN
        ) {
            throw new \Exception('You cannot delete SUPERADMIN!');
        }

        if ($user) {
            $user->delete();

            $datas = [];
            $datas['status'] = 200;
            $datas['message'] = 'Data deleted successfully!';

            return $datas;
        }
    }
}
