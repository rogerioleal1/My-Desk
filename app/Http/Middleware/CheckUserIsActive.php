<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckUserIsActive
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
        if (Auth::user()->status != 1) {
            Auth::logout();

            return redirect('login');
        }

        return $next($request);
    }
}
