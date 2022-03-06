<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Throwable;
use Pythagus\LaravelAbstractBasis\Events\IncomingExceptionEvent;

/**
 * Trait LogException
 * @package Pythagus\LaravelAbstractBasis\Traits
 *
 * @author: Damien MOLINA
 */
trait LogException {

    /**
     * Add a line in the log file.
     *
     * @param Throwable $throwable
     */
    public static function add(Throwable $throwable) {
        event(new IncomingExceptionEvent($throwable)) ;
    }

}
