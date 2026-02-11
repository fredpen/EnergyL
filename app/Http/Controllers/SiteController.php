<?php

namespace App\Http\Controllers;


use App\Http\Requests\Site\StoreSiteRequest;
use App\Services\SiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class SiteController extends Controller
{
   private SiteService $siteService;

   public function __construct(SiteService $siteService)
   {
      $this->siteService = $siteService;
   }


   public function store(StoreSiteRequest $request): JsonResponse
   {
      try {
         $site = $this->siteService->create(
            $request->user(),
            $request['customer_id'],
            $request['name'],
         );
         return $this->created($site);

         //
      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }

   public function mySites(Request $request): JsonResponse
   {
      try {
         return $this->success(
            $this->siteService->fetchByCompany($request->user())
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
            $this->siteService->fetchById($request->user(), $request['siteId'])
         );

         //
      } catch (Throwable $e) {
         return $this->error($e->getMessage());
      }
   }
}
