<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Categorymanager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check() || auth()->user()->role->name !== $role) {
            return redirect('/dashboard')->withErrors(['Access denied to Category Management']);
        }
        
        return $next($request);
    }
}