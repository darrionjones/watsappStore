<?php

namespace App\Http\Middleware;

use App\Helpers\ActiveStore;
use App\Models\Store;
use Closure;
use Illuminate\Http\Request;

class InitializeStoreByDomainOrSubDomain
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
        if (!is_null(store())) {
            return $next($request);
        }

        $domain = $request->getHost();

        $store = Store::where('subdomain', $domain)
            ->orWhere('domains', $domain)
            ->where('is_store_enabled', '1')->first();

        if (is_null($store)) {
            abort(404);
        }

        app(ActiveStore::class)->initialize($store);

        return $next($request);
    }
}
