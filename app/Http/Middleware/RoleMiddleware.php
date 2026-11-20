<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Silakan masuk ke portal admin terlebih dahulu.');
        }

        $user = Auth::user();

        // Superadmin has access to everything
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        if ($role === 'konten' && !$user->canAccessContent()) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang untuk mengakses modul Konten & Syiar Dakwah.');
        }

        if ($role === 'keuangan' && !$user->canAccessFinance()) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang untuk mengakses modul Keuangan & Kas.');
        }

        return $next($request);
    }
}
