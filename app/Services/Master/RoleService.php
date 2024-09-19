<?php

namespace App\Services\Master;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Repositories\Master\RoleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Http\Request;

class RoleService
{
    public $request;
    protected $roleRepository;

    public function __construct(Request $request, RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->request = $request;
    }

    public function saveData()
    {
        $result = $this->roleRepository->save();

        return $result;
    }

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    public function showById($id)
    {
        return $this->roleRepository->showById($id);
    }

    public function edit($id)
    {
        return $this->roleRepository->edit($id);
    }

    public function getById($id)
    {
        return $this->roleRepository->getById($id);
    }

    public function updateData($id)
    {
        DB::beginTransaction();

        try {
            $permission = $this->roleRepository->update($id);
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
            $permission = $this->roleRepository->softDeleteById($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete permission data');
        }

        DB::commit();

        return $permission;
    }

    public function getAbilities()
    {
        return $this->roleRepository->getAbilities();
    }
}
