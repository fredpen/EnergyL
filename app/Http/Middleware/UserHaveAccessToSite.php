<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHaveAccessToSite
{
    public function handle(Request $request, Closure $next): Response
    {
        $siteId = $request->route('siteId');
        $user = $request->user();

        $site = Site::query()
            ->where('id', $siteId)
            ->where('company_id', $user->id)
            ->select(['id', 'company_id'])
            ->first();

        if (!$site) {
            return response()->json(['message' => 'Unauthorized site access'], 403);
        }


        return $next($request);
    }
}
