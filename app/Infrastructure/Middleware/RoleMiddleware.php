<?php

namespace App\Infrastructure\Middleware;

use App\Infrastructure\API\Enums\APIStatusEnum;
use App\Infrastructure\Exceptions\APIResponseException;
use Closure;
use Domain\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (
            ($currentRole = Auth::user()->role)
            !== $role
        )
            throw new APIResponseException([
                "Forbidden!",
                "Your current role: {$currentRole}",
                "Required role: {$role}"
            ], APIStatusEnum::FORBIDDEN);

        return $next($request);
    }
}
