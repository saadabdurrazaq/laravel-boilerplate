<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Services\Master\PermissionService;
use App\Http\Requests\API\Permission\PermissionStoreRequest;
use App\Http\Requests\API\Permission\PermissionUpdateRequest;
use DB;
use Auth;

class PermissionController extends Controller
{
    public $request;
    protected $permissionService;

    public function __construct(Request $request, PermissionService $permissionService)   
    {
        $this->request = $request;
        $this->permissionService = $permissionService;
    }

    /**
     * @OA\Get(
     *     path="/api/master/permissions/check/{permissionName}",
     *     tags={"Permissions"},
     *     summary="Check Permission",
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
    function check($permissionName)
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user->hasPermissionTo($permissionName)) { // $user->hasRole('Super User')
            abort(403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Permission is exist!',
            'user' => $user->hasPermissionTo($permissionName)
        ]);
    } 

    /**
     * @OA\Get(
     *     path="/api/master/permissions/index",
     *     tags={"Permissions"},
     *     summary="Get All Permissions",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(Request $request)
    {
        try {
            $result = $this->permissionService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * @OA\Post(
     *      path="/api/master/permissions/create",
     *      operationId="permissionsStore",
     *      tags={"Permissions"},
     *      summary="Create Permission",
     *      description="Create Permission",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "group_name"},
     *            @OA\Property(property="name", type="string", format="string", example="EAT-FOOD"),
     *            @OA\Property(property="group_name", type="string", format="string", example="FOODS"),
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
    public function create(PermissionStoreRequest $input)
    {
        $input->validated();

        try {
            $result = $this->permissionService->saveData();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    /**
     * @OA\Get(
     *     path="/api/master/permissions/show/{id}",
     *     tags={"Permissions"},
     *     summary="Get Single Permission",
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
            $result = $this->permissionService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * @OA\Put(
     *      path="/api/master/permissions/update/{id}",
     *      tags={"Permissions"},
     *      summary="Update Single Permission",
     *      description="Update Single Permission",
     *      @OA\Parameter(
     *         @OA\Schema(
     *             default="3",
     *             type="string",
     *         ),
     *         name="id",
     *         in="path",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "group_name"},
     *            @OA\Property(property="name", type="string", format="string", example="MASTER_YOYO"),
     *            @OA\Property(property="group_name", type="string", format="string", example="MASTER"),
     *         ),
     *      ),
     *     @OA\Response(response="400", description="Validation errors"),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     security={{"bearerAuth":{}}}
     *  )
     */
    public function update($id, PermissionUpdateRequest $input) 
    {
        $input->validated();

        try {
            $result = $this->permissionService->updateData($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * @OA\Delete(
     *     path="/api/master/permissions/delete/{id}",
     *     tags={"Permissions"},
     *     summary="Soft Delete Single Permission",
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
            $result = $this->permissionService->softDeleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        
        return response()->json($result);
    }
}
