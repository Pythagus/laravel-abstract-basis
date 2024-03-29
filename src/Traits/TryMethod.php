<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Throwable;

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
     * @param bool $json
     * @return mixed
     */
    protected function try(callable $inner, callable $out = null, bool $json = false) {
        try {
            $response = $inner() ;

            return $json ? response()->json($response) : $response ;
        } catch(Throwable $throwable) {
            // If it is a known exception, then it is not 
            // necessary to report the exception.
            if(! $this->isKnownException($throwable)) {
                $this->addThrowableInLog($throwable) ;
            }

            if(! is_null($out)) {
                return $out($throwable) ;
            }

            return $this->redirectUserAfterException($throwable, $json) ;
        }
    }

    /**
     * Try an Ajax call.
     * 
     * @param callable $inner
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ajax(callable $inner) {
        return $this->try($inner, null, true) ;
    }

    /**
     * Redirect the user after encountering a
     * throwable.
     * 
     * @param Throwable $throwable
     * @param bool $json
     * @return \Illuminate\Http\JsonResponse
     */
    protected function redirectUserAfterException(Throwable $throwable, bool $json) {
        if(config('app.debug') && ! $this->isKnownException($throwable)) {
            throw $throwable ;
        }

        if($json) {
            return response()->json([
                'text' => $this->getThrowableMessageOnProduction($throwable),
                'code' => $throwable->getCode(),
            ], 500) ;
        }

        return $this->backError(
            $this->getThrowableMessageOnProduction($throwable)
        )->withInput() ;
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
     * Determine whether the given exception was
     * intentionnaly generated by the code.
     * 
     * @param Throwable $throwable
     * @return bool
     */
    protected function isKnownException(Throwable $throwable) {
        return $throwable instanceof \Pythagus\LaravelAbstractBasis\Exceptions\KnownException ;
    }

    /**
     * Get the exception message when it is not
     * a known exception.
     * 
     * @param Throwable $throwable
     * @return string
     */
    protected function weirdExceptionMessage(Throwable $throwable) {
        return "Une erreur est survenue" ;
    }

    /**
     * Get the message of the throwable regarding its
     * instance.
     *
     * @param Throwable $throwable
     * @return string
     */
    protected function getThrowableMessageOnProduction(Throwable $throwable) {
        return $this->isKnownException($throwable)
            ? $throwable->getMessage()
            : $this->weirdExceptionMessage($throwable) ;
    }
}
