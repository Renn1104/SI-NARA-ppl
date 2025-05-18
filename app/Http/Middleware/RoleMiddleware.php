<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('V_Login');
        }
        
        $user = Auth::user();
        if ($user->role !== $role) {
            abort(403, 'Akses ditolak. Kamu tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
