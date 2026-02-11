<?php

namespace App\Services;

use App\Models\Site;
use App\Models\Company;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class SiteService
{
   /**
    * @throws Exception
    */
   public function create(Company $owner, string $customerId, string $name): Site
   {
      $site = Site::query()
         ->create([
            'company_id' => $owner->id,
            'customer_id' => $customerId,
            'name' => $name,
         ]);

      if (!$site) throw new Exception("Unable to save site");

      return $site;
   }

   public function fetchByCompany(Company $company): LengthAwarePaginator
   {
      return $company->sites()
         ->latest()
         ->paginate(10);
   }

   public function fetchById(Company $company, string $meterId): Model|null
   {
      return $company->sites()
         ->where('id', $meterId)
         ->first();
   }
}
