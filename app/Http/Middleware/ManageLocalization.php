<?php

namespace App\Http\Middleware;

use Closure;

class ManageLocalization
{
    protected $languages = ['en','fr'];

    public function handle($request, Closure $next)
    {
        if(!\Session::has('Lang'))
        {
            \Session::put('Lang', $request->getPreferredLanguage($this->languages));
        }
        app()->setLocale(\Session::get('Lang'));

        return $next($request);
    }
}
