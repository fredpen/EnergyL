<?php

namespace App\Services;

use App\Models\EnergyConsumption;
use App\Models\Meter;
use App\Models\Company;
use App\Models\Site;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class MeterService
{
   /**
    * @throws Exception
    */
   public function create(Company $company, string $siteId, string $meterId, string $type): Meter
   {
      $site = Site::query()->findOrFail($siteId);

      $Meter = Meter::query()
         ->create([
            'company_id' => $company->id,
            'customer_id' => $site->customer->id,
            'type' => $type,
            'meter_id' => $meterId,
            'site_id' => $siteId,
         ]);

      if (!$Meter) throw new Exception("Unable to save Meter");

      return $Meter;
   }

   public function fetchByCompany(Company $company): LengthAwarePaginator
   {
      return $company->meters()
         ->latest()
         ->paginate(10);
   }

   public function fetchById(Company $company, string $meterId): Meter|null
   {
      return $company->meters()
         ->where('id', $meterId)
         ->first();
   }

   public function submitAReading(Company $company, string $meterId, float $reading): void
   {
      $meter = Meter::query()->findOrFail($meterId);
      EnergyConsumption::query()
         ->create([
            'meter_id', $meterId,
            'site_id', $meter->site->id,
            'company_id', $company->id,
            'reading' => $reading
         ]);
   }
}
