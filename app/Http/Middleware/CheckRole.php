<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Menjalankan middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Memastikan pengguna sudah login
        if (Auth::check()) {
            // Mendapatkan role pengguna yang sedang login
            $userRole = Auth::user()->role;

            // Memeriksa apakah role pengguna ada dalam parameter yang diberikan
            if (in_array($userRole, $roles)) {
                return $next($request); // Lanjutkan ke request berikutnya
            }
        }

        // Jika role tidak cocok, redirect ke halaman yang diinginkan
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses untuk halaman ini');
    }
}

