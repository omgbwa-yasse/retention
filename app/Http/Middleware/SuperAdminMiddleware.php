<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->status !== 'superadmin') {
            if ($request->ajax()) {
                return response()->json(['error' => 'Unauthorized. Superadmin access required.'], 403);
            }

            return redirect()->route('home')->with('error', 'Accès non autorisé. Vous devez être un super administrateur pour accéder à cette section.');
        }

        return $next($request);
    }
}
