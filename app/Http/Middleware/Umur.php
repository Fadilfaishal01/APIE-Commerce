<?php

namespace App\Http\Middleware;

use Closure;

class Umur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // Menerima dan memeriksa requestan yg datang dan verifikasi login
    public function handle($request, Closure $next)
    {
        if ($request->umur < 17) {
            return redirect('/failed');
        }

        return $next($request);
    }
}
