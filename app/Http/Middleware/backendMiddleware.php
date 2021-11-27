<?php

namespace App\Http\Middleware;

use Closure;

class backendMiddleware
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
        if (!session('login_backend_sukses')){
            return redirect('/backend');
        }
        return $next($request);
        
    }
}
