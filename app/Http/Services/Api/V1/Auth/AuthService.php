<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use Responser;

    protected UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request) {
        try {
            $data = $request->validated();
            $user = $this->userRepository->create($data);
            return $this->responseSuccess(message: 'User created successfully.', data: new UserResource($user));
        } catch (Exception $e) {
            return $this->responseFail(message: 'Something went wrong while registering.');
        }
    }

    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if($token) {
            return $this->responseSuccess(message: 'Successfully authenticated.', data: new UserResource(auth('api')->user()));
        }
        return $this->responseFail(status: 401, message: 'Wrong credentials.');
    }

    public function logout(){
        try {
            Auth::guard('api')->logout();
            return $this->responseSuccess(message: 'Successfully logged out.');
        } catch (Exception $e) {
            return $this->responseFail(message: 'Something went wrong while logging out.');
        }
    }

    public function refresh(){
        try {
            Auth::guard('api')->refresh();
            return $this->responseSuccess(message: 'Token refreshed successfully.', data: new UserResource(auth('api')->user()));
        } catch (Exception $e) {
            return $this->responseFail(message: 'Something went wrong while refreshing token.');
        }
    }

}
