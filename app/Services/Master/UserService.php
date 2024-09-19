<?php

namespace App\Services\Master;

use App\Http\Requests\API\User\UserStoreRequest;
use Exception;
use App\Models\User;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Master\UserRepository;
use App\Http\Requests\User\UserUpdateRequest;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function saveUserData(UserStoreRequest $request)
    {
        $result = $this->userRepository->save($request);

        return $result;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function showMyData()
    {
        return $this->userRepository->showMe();
    }

    public function updateUser(UserUpdateRequest $request, User $id)
    {
        return $this->userRepository->update($request, $id);
    }

    public function softDeleteById($id)
    {
        return $this->userRepository->softDeleteById($id);
    }
}
