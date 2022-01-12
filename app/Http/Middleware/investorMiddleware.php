<?php

namespace App\Http\Middleware;

use Closure;

class investorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session('login_investor_sukses')) {
            return redirect('/login-investor/');
        }
        return $next($request);
    }
}
