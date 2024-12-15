<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role === 'guest') {
            return $next($request);
        }

        if (auth()->user()->role === 'staff') {
            return redirect()->route('staff.report.index');
        }

        if (auth()->user()->role === 'head_staff') {
            return redirect()->route('head_staff.index');
        }
    }
}