<?php

namespace Pythagus\LaravelAbstractBasis\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use HTMLMin\HTMLMin\Http\Middleware\MinifyMiddleware;

/**
 * Minify the HTML only on production environment.
 * 
 * @author Damien MOLINA
 */
class MinifyHTML extends MinifyMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return Response
     */
    public function handle($request, Closure $next) {
        if(app()->environment('production')) {
            return parent::handle($request, $next) ;
        }

        return $next($request) ;
    }
}
