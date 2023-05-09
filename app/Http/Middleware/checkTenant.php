<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tenantId = $request->header('X-Tenant-ID');
        if (!$tenantId) {
            return response()->json(['error' => 'Missing X-Tenant-ID header'], 400);
        }

        // Check that the tenant with the given ID exists in the database
        $tenant = \App\Models\Tenant::where('tenant_hash', $tenantId)->first();
        if (!$tenant) {
            return response()->json(['error' => 'Invalid X-Tenant-ID header'], 400);
        }

        // Store the tenant in the request for future use
        $request->merge(['tenant' => $tenant]);

        return $next($request);
    }
}
