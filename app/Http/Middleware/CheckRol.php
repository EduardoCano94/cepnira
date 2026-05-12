<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRol
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check() || !in_array(auth()->user()->rol, $roles)) {
            abort(403, 'No tienes permiso para acceder aquí.');
        }
        return $next($request);
    }
}