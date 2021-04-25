<?php

namespace Pythagus\LaravelAbstractBasis\Traits;

use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Pythagus\LaravelAbstractBasis\Redirection;
use Illuminate\Contracts\Foundation\Application;

/**
 * Trait Redirectable
 * @package Pythagus\LaravelAbstractBasis\Traits
 *
 * @author: Damien MOLINA
 */
trait Redirectable {

    /**
     * Redirect back with a success message
     *
     * @param string $msg
     * @return RedirectResponse
     */
    protected function backSuccess(string $msg = null) {
        return $this->redirectSuccess($msg)->back() ;
    }

    /**
     * Redirect back with an error message
     *
     * @param string $msg
     * @return RedirectResponse
     */
    protected function backError(string $msg = null) {
        return $this->redirectError($msg)->back() ;
    }

    /**
     * Redirect back with a warning message
     *
     * @param string $msg
     * @return RedirectResponse
     */
    protected function backWarning(string $msg = null) {
        return $this->redirectWarning($msg)->back() ;
    }

    /**
     * @param string|null $msg
     * @return Application|RedirectResponse|Redirector
     */
    protected function redirectSuccess(string $msg = null) {
        return Redirection::make($msg)->success() ;
    }

    /**
     * @param string|null $msg
     * @return Application|RedirectResponse|Redirector
     */
    protected function redirectError(string $msg = null) {
        return Redirection::make($msg)->error() ;
    }

    /**
     * @param string|null $msg
     * @return Application|RedirectResponse|Redirector
     */
    protected function redirectWarning(string $msg = null) {
        return Redirection::make($msg)->warning() ;
    }

}
