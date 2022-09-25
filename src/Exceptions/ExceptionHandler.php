<?php

namespace Pythagus\LaravelAbstractBasis\Exceptions;

use Illuminate\Validation\ValidationException;

/**
 * Class KnownException
 * @package Pythagus\LaravelAbstractBasis\Exceptions
 *
 * @author: Damien MOLINA
 */
class ExceptionHandler {

    /**
     * Convert a validation excpetion to a
     * flash message.
     *
     * @return \Closure
     */
    public static function validationException() {
        return function(ValidationException $e) {
            try {
                $errors = $e->errors() ;
                $message = array_shift($errors)[0] ;
            } catch(\Throwable $throwable) {
                $message = $e->getMessage() ;
            }

            flash()->error($message) ;
        } ;
    }
}