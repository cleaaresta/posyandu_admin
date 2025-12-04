<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CheckIsLogin
{
    /**
     * Handle an incoming request.
     *
     * Jika user belum terautentikasi:
     *  - untuk request AJAX/JSON kembalikan JSON 401
     *  - untuk request biasa redirect ke rute bernama 'login'
     *
     * Selain itu, bila user sudah login dan mengakses rute login, arahkan ke 'home'
     * (opsional, berguna bila Anda tidak menggunakan middleware terpisah untuk itu).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed (JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response)
     */
    public function handle(Request $request, Closure $next)
    {
        // Debug/logging ringan untuk memastikan middleware terpanggil saat testing
        Log::debug('Middleware CheckIsLogin dijalankan untuk path: ' . $request->path());

        // Jika user belum login, blok akses
        if (! Auth::check()) {
            // Untuk AJAX / API request: kembalikan JSON 401 agar frontend bisa tangani
            if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
                return new JsonResponse(['message' => 'Silahkan login terlebih dahulu!'], 401);
            }

            // Redirect ke rute bernama 'login'
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu!');
        }

        // Jika sudah login dan mencoba mengakses halaman login, arahkan ke home
        // (opsional — hapus blok ini kalau Anda punya middleware terpisah)
        if ($request->routeIs('login') || $request->is('login')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}