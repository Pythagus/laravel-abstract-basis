<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Illuminate\Http\RedirectResponse;
use Pythagus\LaravelAbstractBasis\Redirection;

/**
 * Trait Redirectable
 * @package Pythagus\LaravelAbstractBasis\Traits
 *
 * @author: Damien MOLINA
 */
trait Redirectable {

    /**
     * Redirect back with a success message.
     *
     * @param string $msg
     * @return RedirectResponse
     */
    protected function backSuccess(string $msg = null) {
        return $this->redirectSuccess($msg)->back()->withInput() ;
    }

    /**
     * Redirect back with an error message.
     *
     * @param string $msg
     * @return RedirectResponse
     */
    protected function backError(string $msg = null) {
        return $this->redirectError($msg)->back()->withInput() ;
    }

    /**
     * Redirect back with a warning message.
     *
     * @param string $msg
     * @return RedirectResponse
     */
    protected function backWarning(string $msg = null) {
        return $this->redirectWarning($msg)->back()->withInput() ;
    }

    /**
     * Create a redirection instance with the given
     * success message.
     * 
     * @param string|null $msg
     * @return RedirectResponse
     */
    protected function redirectSuccess(string $msg = null) {
        return Redirection::make($msg)->success() ;
    }

    /**
     * Create a redirection instance with the given
     * error message.
     * 
     * @param string|null $msg
     * @return RedirectResponse
     */
    protected function redirectError(string $msg = null) {
        return Redirection::make($msg)->error() ;
    }

    /**
     * Create a redirection instance with the given
     * warning message.
     * 
     * @param string|null $msg
     * @return RedirectResponse
     */
    protected function redirectWarning(string $msg = null) {
        return Redirection::make($msg)->warning() ;
    }
}
