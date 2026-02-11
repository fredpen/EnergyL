<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactDetail\UpdateContactDetailRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class ContactDetailController extends Controller
{
   private CustomerService $customerService;

   public function __construct(CustomerService $customerService)
   {
      $this->customerService = $customerService;
   }

   public function create(UpdateContactDetailRequest $request): JsonResponse
   {
      $this->customerService->updateContact(
         $request->user(),
         $request['customer_id'],
         $request['contact_email'],
         $request['contact_phone'],
      );

      return $this->success();
   }
}
