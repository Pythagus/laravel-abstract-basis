<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Closure;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Pythagus\LaravelAbstractBasis\Traits\Container;
use Pythagus\LaravelAbstractBasis\Traits\TryMethod;
use Illuminate\Routing\ControllerMiddlewareOptions;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class AbstractController
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractController extends Controller {

    /**
     * Laravel default traits.
     *
     * @version 7.12
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests ;

    /**
     * Custom traits.
     */
    use Container, TryMethod ;

    /**
     * Authorize the middleware with the given closure.
     * The closure should throw an exception.
     *
     * @param Closure $closure
     * @return ControllerMiddlewareOptions
     */
    public function authorizeClosure(Closure $closure) {
        return $this->middleware(function ($request, $next) use ($closure) {
            $closure() ;

            return $next($request) ;
        }) ;
    }

}
