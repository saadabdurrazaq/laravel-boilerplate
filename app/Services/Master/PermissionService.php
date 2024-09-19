<?php

namespace App\Services\Master; 

use Spatie\Permission\Models\Permission;
use App\Repositories\Master\PermissionRepository; 
use App\Repositories\Master\RoleRepository; 
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Http\Request;

class PermissionService
{
    public $request;
    protected $permissionRepository; 
    protected $roleRepository;  

    public function __construct(Request $request, PermissionRepository $permissionRepository, RoleRepository $roleRepository) 
    {
        $this->request = $request;
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function saveData()
    {
        $result = $this->permissionRepository->save(); 

        return $result;
    }

    public function getAll()
    {
        // return $this->permissionRepository->getAll();
        return $this->roleRepository->showSingle(0); 
    }

    public function getById($id)
    {
        return $this->permissionRepository->getById($id);
    }

    public function updateData($id)
    {
        DB::beginTransaction();

        try {
            $permission = $this->permissionRepository->update($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            return response()->json([
                'error' => 'Unable to update permission data' 
            ], 500);
        }

        DB::commit();

        return $permission;
    }

    public function softDeleteById($id)
    {
        DB::beginTransaction();

        try {
            $permission = $this->permissionRepository->softDeleteById($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete permission data');
        }

        DB::commit();

        return $permission;

    }
}