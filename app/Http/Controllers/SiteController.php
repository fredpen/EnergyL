<?php

namespace App\Http\Controllers;


use App\Http\Requests\Site\StoreSiteRequest;
use App\Http\Requests\Site\UpdateSiteRequest;
use App\Models\Site;
use Illuminate\Http\JsonResponse;


class SiteController extends Controller
{
    public function store(StoreSiteRequest $request): JsonResponse
    {
        $site = Site::create($request->validated());

        return $this->created($site);
    }

    public function update(UpdateSiteRequest $request, Site $site): JsonResponse
    {
        $site->update($request->validated());

        return $this->updated($site);
    }
}
