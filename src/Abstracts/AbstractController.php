<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Pythagus\LaravelAbstractBasis\Traits\Container;
use Pythagus\LaravelAbstractBasis\Traits\TryMethod;
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

}
