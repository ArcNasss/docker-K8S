<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Services\Auth\RegisterService;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\LoginService;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected RegisterService $registerService;
    protected LoginService $loginService;

    public function __construct(RegisterService $registerService, LoginService $loginService)
    {
        $this->registerService = $registerService;
        $this->loginService = $loginService;
    }


    public function register(RegisterRequest $request)
    {
        try {
            $request = $request->validated();
            $data = $this->registerService->handleRegister($request);
            return ResponseHelper::success($data, trans('auth.register_success'));
        } catch (\Exception $e) {
            return ResponseHelper::error(trans('auth.register_failed') . $e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $request = $request->validated();
            $data = $this->loginService->handleLogin($request);
            return ResponseHelper::success($data, trans('auth.success'));
        } catch (\Exception $e) {
            return ResponseHelper::error(trans('auth.failed') . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
        } catch (\Exception $e) {
            return ResponseHelper::error(trans('auth.logout_error') . $e->getMessage());
        }
        return ResponseHelper::success(null, trans('auth.logout_success'));
    }

}
