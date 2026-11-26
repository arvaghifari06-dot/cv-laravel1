<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Pengganti pengecekan isset($_SESSION['login']) pada project PHP Native.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('admin_login', false)) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
