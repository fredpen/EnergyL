<?php

namespace App\Http\Controllers;


use App\Http\Requests\Meter\StoreMeterRequest;
use App\Services\MeterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class MeterController extends Controller
{
   private MeterService $meterService;

   public function __construct(MeterService $meterService)
   {
      $this->meterService = $meterService;
   }


   public function store(StoreMeterRequest $request): JsonResponse
   {
      try {
         $site = $this->meterService->create(
            $request->user(),
            $request['site_id'],
            $request['meter_id'],
            $request['type'],
         );
         return $this->created($site);

         //
      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }

   public function myMeters(Request $request): JsonResponse
   {
      try {
         return $this->success(
            $this->meterService->fetchByCompany($request->user())
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
            $this->meterService->fetchById($request->user(), $request['meterId'])
         );

         //
      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }
}
