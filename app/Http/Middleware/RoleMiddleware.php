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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user belum login, redirect ke login
        if (!auth()->check()) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu');
        }

        // Jika role user sesuai dengan role yang diizinkan
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Jika role tidak sesuai
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini');
    }
}
