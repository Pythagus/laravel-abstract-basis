<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse|JsonResponse
     */
    protected function try(callable $inner, callable $out = null) {
        try {
            return $inner() ;
        } catch(Throwable $throwable) {
            if(! $this->knownException($throwable)) {
                LogException::add($throwable) ;
            }

            if(! is_null($out)) {
                return $out($throwable) ;
            }

            return $this->backError(
                $this->knownException($throwable) ? $throwable->getMessage() : $this->weirdExceptionMessage($throwable)
            ) ;
        }
    }

    /**
     * @param Throwable $throwable
     * @return bool
     */
    protected function knownException(Throwable $throwable) {
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
    protected function tryAjax(callable $inner) {
        return $this->try(function() use ($inner) {
            $html = $inner() ;

            return response()->json(compact('html')) ;
        }, function(Throwable $e) {
            $text = $e->getMessage() ;

            return response()->json(compact('text'), 300) ;
        }) ;
    }

}
