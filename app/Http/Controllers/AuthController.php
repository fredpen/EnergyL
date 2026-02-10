<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->login($request['email'], $request['password']);

            return $this->success([
                'user' => $user,
                'token' => $this->userService->createToken($user)
            ]);

            //
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser(
                $request['email'], $request['password'], $request['name']
            );

            return $this->created([
                'user' => $user,
                'token' => $this->userService->createToken($user)
            ]);

            //
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }


}
