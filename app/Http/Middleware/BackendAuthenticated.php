<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class BackendAuthenticated
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
        if(Gate::denies('all') AND Gate::denies('backend')) {
            abort(403, 'You cant access backend.');
        };

        return $next($request);
    }
}
