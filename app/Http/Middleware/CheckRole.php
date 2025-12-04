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
     * Usage:
     *   Route::middleware('checkrole:admin')->group(...);
     *   Route::middleware('checkrole:admin,guest')->group(...);
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // If not logged in -> redirect to login (or return 401 for JSON)
        if (! Auth::check()) {
            if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
                return response()->json(['message' => 'Silahkan login terlebih dahulu!'], Response::HTTP_UNAUTHORIZED);
            }

            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu!');
        }

        // Normalize incoming roles (support "admin,guest" or multiple params)
        $allowed = [];
        foreach ($roles as $r) {
            foreach (explode(',', (string) $r) as $part) {
                $part = trim($part);
                if ($part !== '') {
                    $allowed[] = strtolower($part);
                }
            }
        }

        // If no role restriction, allow
        if (empty($allowed)) {
            return $next($request);
        }

        $userRole = strtolower((string) (Auth::user()->role ?? ''));

        if (in_array($userRole, $allowed, true)) {
            return $next($request);
        }

        // Authenticated but not authorized -> 403 (JSON for AJAX)
        if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
            return response()->json(['message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.'], Response::HTTP_FORBIDDEN);
        }

        abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}