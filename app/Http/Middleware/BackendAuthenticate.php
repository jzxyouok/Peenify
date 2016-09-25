<?php

namespace App\Http\Middleware;

use Closure;

class BackendAuthenticate
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
        $roles = auth()->user()->roles()->pluck('name')->toArray();

        if (!in_array('Administrator', $roles)) {
            return redirect('/home');
        }

        return $next($request);
    }
}
