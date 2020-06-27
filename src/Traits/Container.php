<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Illuminate\Contracts\Foundation\Application;

/**
 * Trait Container
 * @package Pythagus\LaravelAbstractBasis\Traits
 *
 * @author: Damien MOLINA
 */
trait Container {

    /**
     * Resolve the container to use it.
     *
     * @param string $class
     * @return Application|mixed
     */
    protected function resolve(string $class) {
        return resolve($class) ;
    }

}
