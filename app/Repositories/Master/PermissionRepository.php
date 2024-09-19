<?php

namespace App\Repositories\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Spatie\Permission\Models\Permission; 

class PermissionRepository 
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function save()
    {
        $permission = Permission::create([
            'name' => $this->request['name'],
            'group_name' => $this->request['group_name']
        ]);

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['message'] = 'Data created successfully!'; 
        $datas['data'] = $permission->fresh(); 

        return $datas;
    }

    public function getAll()
    {
        $permissionlist = Permission::get();
        $permissionCount = $permissionlist->count();

        $permissions = Permission::orderBy('id', 'desc')->paginate($permissionCount); 

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['permissions'] = $permissions; 
        $datas['items_per_show'] = $permissionCount . ' (All)';

        return $datas;
    }

    public function getById($id)
    {
        $permission = Permission::where('id', $id)->get();

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['permission'] = $permission; 

        return $datas;
    }

    public function update($id)
    {
        $permission = Permission::findOrFail($id); 

        $permission->update([
            'name' => $this->request['name'],
            'group_name' => $this->request['group_name']
        ]);

        $datas = [];
        $datas['success'] = true;
        $datas['status'] = 200;
        $datas['message'] = 'Data updated successfully!';
        $datas['data'] = $permission->fresh(); 

        return $datas;
    }

    public function softDeleteById($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission) {
            $permission->delete();
            
            $datas = [];
            $datas['success'] = true;
            $datas['status'] = 200;
            $datas['message'] = 'Data deleted successfully!';

            return $datas;
        } 
    } 
}