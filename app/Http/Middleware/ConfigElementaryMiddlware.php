<?php

namespace App\Http\Middleware;

use Closure;

class ConfigElementaryMiddlware
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
        //date_default_timezone_set("Africa/Douala");
        return $next($request);
    }
}
