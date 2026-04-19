<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;

class MobileMiddleware
{
    public function handle($request, Closure $next)
    {
        $agent = new Agent();

        // Check if the user is on a mobile or tablet device
        $isMobileOrTablet = $agent->isMobile() || $agent->isTablet();

        // Check if the browser is Chrome or Safari
        $isChromeOrSafari = in_array($agent->browser(), ['Chrome', 'Safari']);

        if ($isMobileOrTablet && $isChromeOrSafari) {
            return $next($request);
        }

        return response()->json(['error' => 'Access restricted to mobile and tablet users using Chrome or Safari only.'], 403);
    }

    
}
