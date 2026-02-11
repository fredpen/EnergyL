<?php


use App\Models\Company;
use App\Models\Customer;
use App\Models\Site;
use App\Services\SiteService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a site for the correct company', function () {

   $company = Company::factory()->create();
   $customer = Customer::factory()->create(['company_id' => $company->id]);

   $service = new SiteService();

   $site = $service->create($company, $customer->id, 'Main Plant');

   expect($site->company_id)->toBe($company->id)
      ->and($site->customer_id)->toBe("$customer->id")
      ->and($site->name)->toBe('Main Plant');

   $this->assertDatabaseHas('sites', [
      'name' => 'Main Plant',
      'company_id' => $company->id,
   ]);
});

it('only fetches sites belonging to the company', function () {

   $companyA = Company::factory()->create();
   $companyB = Company::factory()->create();

   $customerA = Customer::factory()->create(['company_id' => $companyA->id]);
   $customerB = Customer::factory()->create(['company_id' => $companyB->id]);

   Site::factory()->count(3)->create([
      'company_id' => $companyA->id,
      'customer_id' => $customerA->id,
   ]);

   Site::factory()->count(2)->create([
      'company_id' => $companyB->id,
      'customer_id' => $customerB->id,
   ]);

   $service = new SiteService();

   $sites = $service->fetchByCompany($companyA);

   expect($sites->total())->toBe(3);
});


it('does not return site that belongs to another company', function () {

   $companyA = Company::factory()->create();
   $companyB = Company::factory()->create();

   $customerA = Customer::factory()->create(['company_id' => $companyA->id]);
   $customerB = Customer::factory()->create(['company_id' => $companyB->id]);

   $siteA = Site::factory()->create([
      'company_id' => $companyA->id,
      'customer_id' => $customerA->id,
   ]);

   $siteB = Site::factory()->create([
      'company_id' => $companyB->id,
      'customer_id' => $customerB->id,
   ]);

   $service = new SiteService();

   $result = $service->fetchById($companyA, $siteB->id);

   expect($result)->toBeNull();
});


it('fetches site by id only if owned by company', function () {

   $company = Company::factory()->create();
   $customer = Customer::factory()->create(['company_id' => $company->id]);

   $site = Site::factory()->create([
      'company_id' => $company->id,
      'customer_id' => $customer->id,
   ]);

   $service = new SiteService();

   $result = $service->fetchById($company, $site->id);

   expect($result->id)->toBe($site->id);
});
