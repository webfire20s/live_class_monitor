<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $guard): Response
    {
        if (!auth()->guard($guard)->check()) {
            $loginRoute = match ($guard) {
                'admin' => 'admin.login',
                'college' => 'college.login',
                'student' => 'student.login',
                default => 'login',
            };

            return redirect()->route($loginRoute);
        }

        return $next($request);
    }
}
