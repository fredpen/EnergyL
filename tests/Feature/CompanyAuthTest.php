<?php

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('registers a company successfully', function () {

   $company = CompanyService::createUser(
      'fred@gmail.com',
      'password',
      'Fred Energy Ltd'
   );

   expect($company)->toBeInstanceOf(Company::class);

   $this->assertDatabaseHas('companies', [
      'email' => 'fred@gmail.com',
      'name' => 'Fred Energy Ltd',
   ]);

   expect(Hash::check('password', $company->password))->toBeTrue();
});


it('logs in with correct credentials', function () {

   $company = Company::factory()->create([
      'email' => 'fred@gmail.com',
      'password' => Hash::make('password'),
   ]);

   $service = new CompanyService();

   $loggedIn = $service->login('fred@gmail.com', 'password');

   expect($loggedIn->id)->toBe($company->id);
});


it('fails login with wrong password', function () {

   Company::factory()->create([
      'email' => 'fred@gmail.com',
      'password' => Hash::make('password'),
   ]);

   $service = new CompanyService();

   $this->expectException(Exception::class);

   $service->login('fred@gmail.com', 'wrong-pass');
});


it('fails login when email does not exist', function () {

   $service = new CompanyService();

   $this->expectException(Exception::class);

   $service->login('missing@gmail.com', 'password');
});


it('creates api token for company', function () {

   $company = Company::factory()->create();

   $token = CompanyService::createToken($company);

   expect($token)
      ->toBeString()
      ->and(strlen($token))
      ->toBeGreaterThan(10);
});
