<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class AuthRepository
{
    protected $user;
    public $request;

    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function signIn()
    {
        $user = $this->user->where('username', $this->request->username)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        $auth = request()->user();

        if ($auth->is_active == 1) {
            $datas = [];

            $datas['status'] = 200;
            $datas['message'] = 'Login success';
            $datas['access_token'] = $token;
            $datas['token_type'] = 'Bearer';
            $datas['name']   = $auth->name;
            $datas['username']   = $auth->username;
            $datas['role']       = $auth->roles->pluck('name')[0] ?? '';
            $datas['permission'] = request()->user()->getAllPermissions()->toArray(); // $permissions;

            return $datas;
        } else {
            $datas = [];

            $datas['message'] = 'User is not active!';
            return $datas;
        }
    }

    public function signOut()
    {
        Auth::user()->tokens()->delete();
    }

    public function currentUser()
    {
        $user = User::find(auth()->id());
        $user->access_token = $user->createToken('auth_token')->plainTextToken;

        return $user;
    }
}
