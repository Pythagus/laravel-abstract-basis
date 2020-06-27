<?php

namespace Pythagus\LaravelAbstractBasis;

use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class Redirection
 * @package Pythagus\LaravelAbstractBasis
 *
 * @property string text
 *
 * @author: Damien MOLINA
 */
class Redirection {

    /**
     * Alert text.
     *
     * @var string
     */
    private $text ;

    /**
     * @param string|null $text
     */
    public function __construct(string $text = null) {
        $this->text = $text ;
    }

    /**
     * @param string|null $text
     * @return Redirection
     */
    public static function make(string $text = null) {
        return new Redirection($text) ;
    }

    /**
     * Set the type of the alert.
     *
     * @param string $type
     * @return Application|RedirectResponse|Redirector
     */
    private function setType(string $type) {
        if(! is_null($this->text)) {
            flash($this->text, $type) ;
        }

        return redirect() ;
    }

    /**
     * Set the alert as success.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function success() {
        return $this->setType('success') ;
    }

    /**
     * Set the alert as error.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function error() {
        return $this->setType('error') ;
    }

    /**
     * Set the alert as warning.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function warning() {
        return $this->setType('warning') ;
    }

}
