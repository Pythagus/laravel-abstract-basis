<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Throwable;
use Illuminate\Http\JsonResponse;
use Pythagus\LaravelAbstractBasis\MyException;

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
     * @param Throwable $throwable
     */
    protected function addThrowableInLog(Throwable $throwable) {
        try {
            TryMethod::logException($throwable) ;
        } catch(Throwable $throwable) {}
    }

    /**
     * @param Throwable $throwable
     * @return bool
     */
    protected function isKnownException(Throwable $throwable) {
        return $throwable instanceof MyException ;
    }

    /**
     * @param Throwable $throwable
     * @return string
     */
    protected function weirdExceptionMessage(Throwable $throwable) {
        return "An error occurred" ;
    }

    /**
     * @param callable $inner
     * @return JsonResponse
     */
    protected function ajax(callable $inner) {
        return $this->try(function() use ($inner) {
            $data = $inner() ;

            return response()->json($data) ;
        }, function(Throwable $throwable) {
            $text = $this->getThrowableMessage($throwable) ;

            return response()->json(compact('text'), 500) ;
        }) ;
    }

    /**
     * Add a line in the log file.
     *
     * @param Throwable $throwable
     */
    public static function logException(Throwable $throwable) {
        // TODO log exception.
    }
}
