<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrustCloudflare
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('CF-Connecting-IP')) {
            $request->server->set('REMOTE_ADDR', $request->header('CF-Connecting-IP'));
        }

        return $next($request);
    }
}
