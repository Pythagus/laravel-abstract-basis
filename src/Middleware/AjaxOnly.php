<?php

namespace Pythagus\LaravelAbstractBasis\Middleware;

use Closure;

/**
 * Class AjaxOnly
 * @package Pythagus\LaravelAbstractBasis\Middleware
 *
 * @author: Damien MOLINA
 */
class AjaxOnly {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(! $request->ajax()) {
            abort(404) ;
        }

        return $next($request) ;
    }

}
