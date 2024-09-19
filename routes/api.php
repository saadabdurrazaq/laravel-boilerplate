<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\PermissionController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Comment\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
//     // Route::post('refresh', [AuthController::class, 'refresh']);
//     // Route::put('/auth/update-profile', [AccountSettingController::class, 'updateProfile']);
//     // Route::put('/auth/update-password', [AccountSettingController::class, 'updatePassword']);
// });

Route::post('register', [UserController::class, 'store']);

Route::post('auth/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'auth'], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
});

// dashboard
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'dashboard'], function ($router) {
    //
});

// Master
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'master'], function ($router) {
    // users
    Route::get('users/index', [UserController::class, 'index']);
    Route::get('users/show/{id}', [UserController::class, 'show']);
    Route::get('users/my-data', [UserController::class, 'me']);
    Route::put('users/update/{id}', [UserController::class, 'update']);
    Route::delete('users/delete/{id}', [UserController::class, 'destroy']);

    // permissions
    Route::post('permissions/create', [PermissionController::class, 'create']);
    Route::get('permissions/index', [PermissionController::class, 'index']);
    Route::get('permissions/show/{id}', [PermissionController::class, 'show']);
    Route::get('permissions/check/{permissionName}', [PermissionController::class, 'check']);
    Route::put('permissions/update/{id}', [PermissionController::class, 'update']);
    Route::delete('permissions/delete/{id}', [PermissionController::class, 'destroy']);

    // roles
    Route::get('roles/create', [RoleController::class, 'create']);
    Route::post('roles/store', [RoleController::class, 'store']);
    Route::get('roles/index', [RoleController::class, 'index']);
    Route::get('roles/show/{id}', [RoleController::class, 'show']);
    Route::get('roles/edit/{id}', [RoleController::class, 'edit']);
    Route::delete('roles/delete/{id}', [RoleController::class, 'destroy']);
    Route::put('roles/update/{id}', [RoleController::class, 'update']);
    Route::post('roles/abilities', [RoleController::class, 'abilities']);
});

// post
Route::get('posts', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::get('posts/{id}', [PostController::class, 'show'])->middleware('auth:sanctum');
Route::post('posts', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::put('posts/{id}', [PostController::class, 'update'])->middleware('auth:sanctum');
Route::delete('posts/{id}', [PostController::class, 'destroy'])->middleware('auth:sanctum');

// comment
Route::post('comments/store', [CommentController::class, 'store'])->middleware('auth:sanctum');

