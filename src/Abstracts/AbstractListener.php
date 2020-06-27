<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Throwable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pythagus\LaravelAbstractBasis\Traits\Container;
use Pythagus\LaravelAbstractBasis\Traits\LogException;

/**
 * Class AbstractListener
 * @package App\Listeners
 *
 * @author: Damien MOLINA
 */
abstract class AbstractListener implements ShouldQueue {

    use InteractsWithQueue, Container ;

    /**
     * @param callable $inner
     */
    protected function try(callable $inner) {
        try {
            $inner() ;
        } catch(Throwable $throwable) {
            LogException::add($throwable) ;
        }
    }

}
