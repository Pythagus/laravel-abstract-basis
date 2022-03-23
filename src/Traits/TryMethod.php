<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Throwable;
use Illuminate\Http\JsonResponse;
use Pythagus\LaravelAbstractBasis\Contracts\KnownException;

/**
 * Trait TryMethod
 * @package Pythagus\LaravelAbstractBasis\Traits
 *
 * @author: Damien MOLINA
 */
trait TryMethod {

    use Redirectable ;

    /**
     * Make a Try-Catch block and return the result.
     *
     * @param callable $inner
     * @param callable|null $out
     * @return mixed
     */
    protected function try(callable $inner, callable $out = null) {
        try {
            return $inner() ;
        } catch(Throwable $throwable) {
            if(! $this->isKnownException($throwable)) {
                $this->addThrowableInLog($throwable) ;
            }

            if(! is_null($out)) {
                return $out($throwable) ;
            }

            return $this->backError($this->getThrowableMessage($throwable)) ;
        }
    }

    /**
     * Try an Ajax call.
     * 
     * @param callable $inner
     * @return JsonResponse
     */
    protected function ajax(callable $inner) {
        return $this->try(function() use ($inner) {
            return response()->json($inner()) ;
        }, function(Throwable $throwable) {
            $text = $this->getThrowableMessage($throwable);

            return response()->json(compact('text'), 500) ;
        }) ;
    }

    /**
     * Get the message of the throwable regarding its
     * instance.
     *
     * @param Throwable $throwable
     * @return string
     */
    private function getThrowableMessage(Throwable $throwable) {
        return $this->isKnownException($throwable)
            ? $throwable->getMessage()
            : $this->weirdExceptionMessage($throwable) ;
    }

    /**
     * Log the incoming throwable.
     * 
     * @param Throwable $throwable
     */
    public function addThrowableInLog(Throwable $throwable) {
        report($throwable) ;
    }

    /**
     * @param Throwable $throwable
     * @return bool
     */
    protected function isKnownException(Throwable $throwable) {
        return $throwable instanceof KnownException ;
    }

    /**
     * @param Throwable $throwable
     * @return string
     */
    protected function weirdExceptionMessage(Throwable $throwable) {
        return "An error occurred" ;
    }
}
