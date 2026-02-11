<?php

use App\Models\Company;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a customer under the correct company', function () {

   $company = Company::factory()->create();
   $service = new CustomerService();

   $customer = $service->create(
      $company,
      'Fred Corp',
      'fred@energy.com',
      '07123456789',
      'PDF'
   );

   expect($customer->company_id)->toBe($company->id);

   $this->assertDatabaseHas('customers', [
      'name' => 'Fred Corp',
      'company_id' => $company->id,
   ]);
});

it('fetches only customers belonging to the company', function () {

   $companyA = Company::factory()->create();
   $companyB = Company::factory()->create();

   Customer::factory()->count(3)->create(['company_id' => $companyA->id]);
   Customer::factory()->count(2)->create(['company_id' => $companyB->id]);

   $service = new CustomerService();

   $result = $service->fetchByCompany($companyA);

   expect($result->total())->toBe(3);
});


it('returns customer when owned by company', function () {

   $company = Company::factory()->create();
   $customer = Customer::factory()->create(['company_id' => $company->id]);

   $service = new CustomerService();

   $found = $service->fetchByCustomerId($company, $customer->id);

   expect($found->id)->toBe($customer->id);
});


it('does not return customer belonging to another company', function () {

   $companyA = Company::factory()->create();
   $companyB = Company::factory()->create();

   $foreignCustomer = Customer::factory()->create(['company_id' => $companyB->id]);

   $service = new CustomerService();

   $result = $service->fetchByCustomerId($companyA, $foreignCustomer->id);

   expect($result)->toBeNull();
});


it('updates contact details for owned customer', function () {

   $company = Company::factory()->create();
   $customer = Customer::factory()->create(['company_id' => $company->id]);

   CustomerService::updateContact(
      $company,
      $customer->id,
      'new@email.com',
      '07999999999'
   );

   $this->assertDatabaseHas('customers', [
      'id' => $customer->id,
      'contact_email' => 'new@email.com',
      'contact_phone' => '07999999999',
   ]);
});



it('does not update contact of another company customer', function () {

   $companyA = Company::factory()->create();
   $companyB = Company::factory()->create();

   $customerB = Customer::factory()->create(['company_id' => $companyB->id]);

   CustomerService::updateContact(
      $companyA,
      $customerB->id,
      'hacked@email.com',
      '07000000000'
   );

   expect($customerB->fresh()->contact_email)->not->toBe('hacked@email.com');
});


it('updates billing preference for owned customer', function () {

   $company = Company::factory()->create();
   $customer = Customer::factory()->create([
      'company_id' => $company->id,
      'billing_preference' => 'PDF'
   ]);

   CustomerService::manageBillingPreference($company, $customer->id, 'CSV');

   expect($customer->fresh()->billing_preference)->toBe('CSV');
});


it('does not update billing preference for foreign customer', function () {

   $companyA = Company::factory()->create();
   $companyB = Company::factory()->create();

   $customerB = Customer::factory()->create([
      'company_id' => $companyB->id,
      'billing_preference' => 'PDF'
   ]);

   CustomerService::manageBillingPreference($companyA, $customerB->id, 'EDI');

   expect($customerB->fresh()->billing_preference)->toBe('PDF');
});
