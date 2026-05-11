<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Usermanager
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Admin, Manager စသဖြင့် roles မျိုးစုံ စစ်လို့ရအောင် ...$roles (spread operator) သုံးထားတယ်
        if (!auth()->check() || !in_array(auth()->user()->role->name, $roles)) {
            return redirect('/dashboard')->withErrors(['Access denied: You do not have permission.']);
        }

        return $next($request);
    }
}