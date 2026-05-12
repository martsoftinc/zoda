<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TutorialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    if (!auth()->check()) {
        return $next($request);
    }

    // ADD 'tutorial.complete' TO THIS ARRAY
    if ($request->routeIs('tutorial.page') || 
        $request->routeIs('tutorial.complete') || 
        $request->routeIs('logout')) {
        return $next($request);
    }

    if (strtolower(auth()->user()->tutorial) !== 'yes') {
        return redirect()->route('tutorial.page');
    }

    return $next($request);
}
    
}
