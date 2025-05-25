<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            // Check if user has the role
            if ($user->role == $role) {
                return $next($request);
            }
        }

        // If user is cook or pastry trying to access dashboard, redirect to evaluasi
        if (($user->role === 'cook' || $user->role === 'pastry') && $request->routeIs('dashboard')) {
            return redirect()->route('evaluasi.index');
        }

        abort(403, 'Unauthorized action.');
    }
}
