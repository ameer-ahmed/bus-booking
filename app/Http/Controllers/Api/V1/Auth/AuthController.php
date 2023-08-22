<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Services\Api\V1\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $auth;

    public function __construct(
        AuthService $auth,
    )
    {
        $this->middleware('auth:api')->only(['logout', 'refresh']);
        $this->auth = $auth;
    }

    public function register(RegisterRequest $request) {
        return $this->auth->register($request);
    }

    public function login(LoginRequest $request) {
        return $this->auth->login($request);
    }

    public function logout() {
        return $this->auth->logout();
    }

    public function refresh() {
        return $this->auth->refresh();
    }
}
