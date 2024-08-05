<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();
        $cacheKey = 'visitor_' . $ipAddress;

        if (!Cache::has($cacheKey)) {
            Cache::increment('visitor_count');
            Cache::put($cacheKey, true, 86400);
        }

        return $next($request);
    }
}
