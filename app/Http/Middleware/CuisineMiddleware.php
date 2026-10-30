<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CuisineMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['cuisine', 'gerant'])) {
            abort(403, 'Accès réservé à la cuisine.');
        }

        return $next($request);
    }
}