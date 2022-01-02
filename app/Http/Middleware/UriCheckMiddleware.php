<?php

namespace App\Http\Middleware;

use Closure;

class UriCheckMiddleware
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
        $current_url = url()->current();
        $exceptions = array(
            "/.env",
            "/app",
            "/bootstrap",
            "/config",
            "/database",
            "/node_modules",
            "/resources",
            /*"/public",*/
            "/routes",
            "/storage",
            "/tests",
            "/vendor",
            "/.gitattributes",
            "/.gitignore",
            "/artisan",
            "/composer.",
            "/firebase-messaging-sw.js",
            "/mix-manifest.json",
            "/package.json",
            "/phpunit.xml",
            "/readme.md",
            "/robots.txt",
            "/web.config",
            "/webpack.mix.js",
            "/js",
            "/css",
            "/assets",
            "/assetsLandin",
            "/chat-box",
            "/calebdrier",
            "/files",
            "/images",
            "/material",
            "/photos",
            "/test",
            "/startUI"
        );

        //dd(strpos(url()->current(), '/app'));

        for ($i=0; $i < count($exceptions); $i++) { 
            if (strpos($current_url, $exceptions[$i]) !== false) {
                return response()->view('vendor.exceptions.pageNotFound',[],404);
            }
        }
        return $next($request);
    }
}
