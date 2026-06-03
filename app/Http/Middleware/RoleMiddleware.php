<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return ResponseHelper::error(null, 'Unauthenticated.', 401);
        }

        if (! $request->user()->hasAnyRole($roles)) {
            return ResponseHelper::error(null, 'Forbidden. You do not have access.', 403);
        }

        return $next($request);
    }
}
