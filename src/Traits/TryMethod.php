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
            $this->addThrowableInLog($throwable) ;

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
        if(app()->environment('local')) {
            throw $throwable ;
        }

        if($json) {
            return response()->json([
                'text' => $throwable->getMessage(),
                'code' => $throwable->getCode(),
            ], 500) ;
        }

        return $this->backError($throwable->getMessage())->withInput() ;
    }

    /**
     * Log the incoming throwable.
     * 
     * @param Throwable $throwable
     */
    public function addThrowableInLog(Throwable $throwable) {
        report($throwable) ;
    }
}
