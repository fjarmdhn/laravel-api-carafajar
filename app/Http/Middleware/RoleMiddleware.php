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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $role): Response
    // {
    //     // Lakukan pengecekan peran di sini
    //     $user = $request->user();

    //     if (!$user || (!$user->hasRole('admin') && !$user->hasRole('author'))) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     // Jika Anda ingin memeriksa peran secara spesifik, sesuaikan logika di sini
    //     if ($role === 'admin' && !$user->hasRole('admin')) {
    //         abort(403, 'Unauthorized action. Admin role required.');
    //     }

    //     if ($role === 'author' && !$user->hasRole('author')) {
    //         abort(403, 'Unauthorized action. Author role required.');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user || (!$user->hasRole('admin') && !$user->hasRole('author'))) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        // Jika Anda ingin memeriksa peran secara spesifik, sesuaikan logika di sini
        if ($role === 'admin' && !$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized action. Admin role required.'], 403);
        }

        if ($role === 'author' && !$user->hasRole('author')) {
            return response()->json(['message' => 'Unauthorized action. Author role required.'], 403);
        }

        return $next($request);
    }
}
