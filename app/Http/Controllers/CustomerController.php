<?php

namespace App\Http\Controllers;


use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateBillingPreferenceRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CustomerController extends Controller
{
   private CustomerService $customerService;

   public function __construct(CustomerService $customerService)
   {
      $this->customerService = $customerService;
   }

   public function store(StoreCustomerRequest $request): JsonResponse
   {
      try {
         $customer = $this->customerService->create(
            $request->user(),
            $request['name'],
            $request['contact_email'],
            $request['contact_phone'],
            $request['billing_preference'],
         );
         return $this->created($customer);

         //
      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }

   public function myCustomers(Request $request): JsonResponse
   {
      try {
         return $this->success(
            $this->customerService->fetchByCompany($request->user())
         );

         //
      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }

   public function show(Request $request): JsonResponse
   {
      try {
         return $this->success(
            $this->customerService->fetchByCustomerId($request->user(), $request['customerId'])
         );
      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }

   public function billingPreference(UpdateBillingPreferenceRequest $request): JsonResponse
   {
      try {
         $this->customerService->manageBillingPreference(
            $request->user(),
            $request['customer_id'],
            $request['billing_preference']
         );
         return $this->success();

      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }
}
