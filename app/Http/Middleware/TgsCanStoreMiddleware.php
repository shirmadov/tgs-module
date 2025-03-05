<?php

namespace Modules\Tgs\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TgsCanStoreMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $apikey = $request->header('X-API-KEY');
        if(!$apikey || $apikey != env('TGS_API_KEY')) {
            return response()->json(['error'=>"You can't store"],401);
        }

        return $next($request);
    }
}
