<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\API\Role\RoleStoreRequest;
use App\Http\Requests\API\Role\RoleUpdateRequest;
use App\Services\Master\RoleService;
use Illuminate\Support\Facades\DB;
use Auth;

class RoleController extends Controller
{
    public $request;
    protected $roleService;

    public function __construct(Request $request, RoleService $roleService)
    {
        $this->request = $request;
        $this->roleService = $roleService;
    }

    /**
     * @OA\Get(
     *     path="/api/master/roles/index",
     *     tags={"Roles"},
     *     summary="Get All Roles With Its Permissions",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index()
    {
        try {
            $result = $this->roleService->getAll();
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function create()
    {
        $permissions = Permission::get();

        return response()->json([
            'permissions' => $permissions,
        ], 200);
    }

    /**
     * @OA\Post(
     *      path="/api/master/roles/store",
     *      tags={"Roles"},
     *      summary="Create Role",
     *      description="Create Role",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "permissions_id"},
     *            @OA\Property(property="name", type="string", format="string", example="SPIDERMAN"),
     *            @OA\Property(property="permissions_id", type="array", @OA\Items(type="integer"), example={3, 4}),
     *         ),
     *      ),
     *     @OA\Response(response="400", description="Validation errors"),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     security={{"bearerAuth":{}}}
     *  )
     */
    public function store(RoleStoreRequest $input)
    {
        $input->validated();

        try {
            DB::beginTransaction();
            $result = $this->roleService->saveData();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * @OA\Get(
     *     path="/api/master/roles/show/{id}",
     *     tags={"Roles"},
     *     summary="Get Single Role",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         @OA\Schema(
     *             default="3",
     *             type="string",
     *         ),
     *         name="id",
     *         in="path",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     * )
     */
    public function show($id)
    {
        try {
            $result = $this->roleService->showById($id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * @OA\Get(
     *     path="/api/master/roles/edit/{id}",
     *     tags={"Roles"},
     *     summary="Edit Single Role",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         @OA\Schema(
     *             default="3",
     *             type="string",
     *         ),
     *         name="id",
     *         in="path",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     * )
     */
    public function edit($id)
    {
        try {
            $result = $this->roleService->edit($id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * @OA\Put(
     *      path="/api/master/roles/update/{id}",
     *      tags={"Roles"},
     *      summary="Update Single Role With Its Permissions",
     *      description="Update Single Role With Its Permissions",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Buscar por estado",
     *         required=true,
     *         @OA\Schema(
     *             default="15",
     *             type="string",
     *         ),
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "permissions_id"},
     *            @OA\Property(property="name", type="string", format="string", example="CATMAN"),
     *            @OA\Property(property="permissions_id", type="array", @OA\Items(type="integer"), example={5, 6}),
     *         ),
     *      ),
     *     @OA\Response(response="400", description="Validation errors"),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     security={{"bearerAuth":{}}}
     *  )
     */
    public function update(Request $request, $id, RoleUpdateRequest $input)
    {
        $input->validated();

        try {
            $result = $this->roleService->updateData($id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * @OA\Delete(
     *     path="/api/master/roles/delete/{id}",
     *     tags={"Roles"},
     *     summary="Soft Delete Single Role",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         @OA\Schema(
     *             default="3",
     *             type="string",
     *         ),
     *         name="id",
     *         in="path",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     * )
     */
    public function destroy($id)
    {
        try {
            $result = $this->roleService->softDeleteById($id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function abilities()
    {
        try {
            $result = $this->roleService->getAbilities();
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}
