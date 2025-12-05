<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(Response::HTTP_FORBIDDEN, 'Anda harus masuk terlebih dahulu.');
        }

        if (empty($roles)) {
            return $next($request);
        }

        $allowed = array_map('strtolower', $roles);

        if (! in_array(strtolower($user->role), $allowed, true)) {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki akses untuk tindakan ini.');
        }

        return $next($request);
    }
}
