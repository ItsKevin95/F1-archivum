<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Csak az admin (role == 1) mehet tovább, mindenki mást a főoldalra irányítunk.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role != 1) {
            return redirect()->route('home')->with('hiba', 'Ehhez az oldalhoz admin jogosultság szükséges.');
        }

        return $next($request);
    }
}
