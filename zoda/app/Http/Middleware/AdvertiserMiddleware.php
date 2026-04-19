<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdvertiserMiddleware
{
      public function handle($request, Closure $next)
    {
       
        if (Auth::check() && Auth::user()->role === 'advertiser') {
            return $next($request); // Allow the request to proceed
        }

        // Redirect or handle unauthorized access for non-admin users
        return redirect('/')->with('error', 'Unauthorized access.');
    
    }
}
