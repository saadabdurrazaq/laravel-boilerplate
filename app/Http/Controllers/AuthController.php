<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public $request;
    protected $authService;

    public function __construct(Request $request, AuthService $authService)
    {
        $this->request = $request;
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     summary="Authenticate user and generate JWT token",
     *     @OA\Parameter(
     *         @OA\Schema(
     *             default="admin",
     *             type="string",
     *         ),
     *         name="username",
     *         in="query",
     *         description="User's username",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         @OA\Schema(
     *             default="admin",
     *             type="string",
     *         ),
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'message' => 'Your username and password doesnt match!'
            ], 401);
        }

        try {
            $result = $this->authService->loginUser();
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function logout()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->authService->logoutUser();
        } catch (\Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
