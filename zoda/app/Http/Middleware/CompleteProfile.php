<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    $user = auth()->user();
 
    // Only apply to authenticated users
    if (!$user) {
        return $next($request);
    }
 
    // Don't redirect if already on the profile completion page or its POST route
    // to prevent an infinite redirect loop
    if ($request->routeIs('profile.complete') || $request->routeIs('profile.complete.save')) {
        return $next($request);
    }
 
    // Check if required fields are missing or set to defaults
    if ($user->country === 'Not specified' ||
        $user->phone === 'Not provided' ||
        $user->age_group === 'Not specified') {
        return redirect()->route('profile.complete');
    }
 
    return $next($request);
}
}
