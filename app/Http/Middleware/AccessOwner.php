<?php

namespace App\Http\Middleware;

use Closure;

class AccessOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $class
     * @return mixed
     */
    public function handle($request, Closure $next, $class)
    {
        $instance = app('\\App\\' . ucfirst($class))->find($request->route()->parameter('comment'));

        if ($instance->user_id != auth()->user()->id) {
            return redirect('/home');
        }

        return $next($request);
    }
}
