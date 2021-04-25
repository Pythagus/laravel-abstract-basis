<?php

namespace Pythagus\LaravelAbstractBasis\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class HttpsProtocol
 * @package Pythagus\LaravelAbstractBasis\Middleware
 *
 * @author: Damien MOLINA
 */
class HttpsProtocol {

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(! $request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri()) ;
        }

        return $next($request) ;
    }

}
