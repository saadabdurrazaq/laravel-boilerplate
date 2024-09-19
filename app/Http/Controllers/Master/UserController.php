<?php

namespace App\Http\Controllers\Master;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Master\UserService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UserUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\API\User\UserStoreRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public $request;
    protected $userService;

    public function __construct(Request $request, UserService $userService)
    {
        $this->request = $request;
        $this->userService = $userService;

        // $this->middleware('permission:MASTER_DATA_READ', ['only' => ['index', 'show']]);
        // $this->middleware('permission:MASTER_DATA_CREATE', ['only' => ['store']]);
        // $this->middleware('permission:MASTER_DATA_UPDATE', ['only' => ['update']]);
        // $this->middleware('permission:MASTER_DATA_DELETE', ['only' => ['destroy']]);
    }

    /**
     * @OA\Post(
     *      path="/api/master/users/register",
     *      operationId="store",
     *      tags={"Users"},
     *      summary="Register User",
     *      description="Register User",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "username", "password", "is_active", "role_id"},
     *            @OA\Property(property="name", type="string", format="string", example="Yuri"),
     *            @OA\Property(property="username", type="string", format="string", example="yuri"),
     *            @OA\Property(property="password", type="string", format="string", example="12345678"),
     *            @OA\Property(property="is_active", type="string", format="string", example="1"),
     *            @OA\Property(property="role_id", type="string", format="string", example="13"),
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
    public function store(UserStoreRequest $request)
    {
        $result = ['status' => 200];

        try {
            DB::beginTransaction();
            $result['data'] = $this->userService->saveUserData($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return apiErrorGetResponse(
                $e,
                'Something went wrong.'
            );
        }

        return response()->json($result, $result['status']);
    }

    /**
     * @OA\Get(
     *     path="/api/master/users/index",
     *     tags={"Users"},
     *     summary="Get All Users",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(Request $request)
    {
        try {
            $result = $this->userService->getAll();
        } catch (\Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return response()->json($result);
    }

    /**
     * @OA\Get(
     *     path="/api/master/users/show/{id}",
     *     tags={"Users"},
     *     summary="Get Single User",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
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
            $result = $this->userService->getById($id);
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * @OA\Get(
     *     path="/api/master/users/my-data",
     *     tags={"Users"},
     *     summary="Show My Data",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}},
     * )
     */
    public function me()
    {
        try {
            $result = $this->userService->showMyData();
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
     *      path="/api/master/users/update/{id}",
     *      operationId="update",
     *      tags={"Users"},
     *      summary="Update Single User",
     *      description="Update Single User",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "username", "is_active"},
     *            @OA\Property(property="name", type="string", format="string", example="Yuri"),
     *            @OA\Property(property="username", type="string", format="string", example="yuri"),
     *            @OA\Property(property="is_active", type="string", format="string", example="1"),
     *            @OA\Property(property="role_id", type="string", format="string", example="1"),
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
    public function update(UserUpdateRequest $request, User $id)
    {
        $result = [
            'status' => 200,
            'message' => 'Data updated successfully!'
        ];

        try {
            DB::beginTransaction();
            $result['data'] = $this->userService->updateUser($request, $id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            return apiErrorGetResponse(
                $e,
                'Something went wrong',
            );
        }

        return response()->json($result);
    }

    /**
     * @OA\Delete(
     *     path="/api/master/users/delete/{id}",
     *     tags={"Users"},
     *     summary="Soft Delete Single User",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Buscar por estado",
     *         required=true,
     *      ),
     * )
     */
    public function destroy($id)
    {
        $result = ['status' => 200, 'message' => 'Data deleted successfully!'];

        DB::beginTransaction();

        try {
            $result['data'] = $this->userService->softDeleteById($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
                'message' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
