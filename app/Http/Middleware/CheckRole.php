<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            abort(403, 'Vous n\'êtes pas autorisé.');
        }

        return $next($request);
    }
}
