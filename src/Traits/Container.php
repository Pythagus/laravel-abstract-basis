<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

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
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    protected function resolve(string $class) {
        return resolve($class) ;
    }
}
