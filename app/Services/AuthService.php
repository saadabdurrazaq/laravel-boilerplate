<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; 
use InvalidArgumentException;
use App\Models\User;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function loginUser()
    {
        return $this->authRepository->signIn(); 
    }

    public function logoutUser()
    {
        return $this->authRepository->signOut(); 
    }
}