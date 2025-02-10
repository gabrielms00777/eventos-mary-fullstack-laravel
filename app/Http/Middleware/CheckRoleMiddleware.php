<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // if(! $request->user()){
            //     abort(403, 'Unauthorized');
            // }

        $requiredRole = UserTypeEnum::tryFrom($role);
        // dd($request->user()->role, $requiredRole);

        if (! $requiredRole || $request->user()->role !== $requiredRole) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
