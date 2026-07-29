<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        $user = auth()->user();

        // Super Admin boleh mengakses semua route admin
        if ($role === 'admin' && in_array($user->role, ['admin', 'super_admin'])) {
            return $next($request);
        }

        if ($user->role !== $role) {
            abort(403, 'AKSES DITOLAK.');
        }

        return $next($request);
    }
}