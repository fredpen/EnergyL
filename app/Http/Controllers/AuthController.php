<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthController extends Controller
{
   private CompanyService $customerService;

   public function __construct(CompanyService $customerService)
   {
      $this->customerService = $customerService;
   }

   public function login(LoginRequest $request): JsonResponse
   {
      try {
         $user = $this->customerService->login(
            $request['email'],
            $request['password']
         );

         return $this->success([
            'user' => $user,
            'token' => $this->customerService->createToken($user)
         ]);

         //
      } catch (Throwable $e) {
         return $this->fail($e->getMessage());
      }
   }

   public function register(RegisterRequest $request): JsonResponse
   {
      try {
         $user = $this->customerService->createUser(
            $request['email'],
            $request['password'],
            $request['name']
         );

         return $this->created([
            'user' => $user,
            'token' => $this->customerService->createToken($user)
         ]);

         //
      } catch (Throwable $e) {
         return $this->fail($e->getMessage());
      }
   }
}
