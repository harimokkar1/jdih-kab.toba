<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'super_admin') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Super Admin access required.'], 403);
            }
            return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak! Menu ini hanya dapat diakses oleh Super Admin.');
        }

        return $next($request);
    }
}

