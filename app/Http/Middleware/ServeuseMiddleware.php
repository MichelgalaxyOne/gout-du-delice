<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServeuseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['serveuse', 'gerant'])) {
            abort(403, 'Accès réservé au personnel de salle.');
        }

        return $next($request);
    }
}