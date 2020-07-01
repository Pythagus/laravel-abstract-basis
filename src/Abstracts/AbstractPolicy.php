<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Closure;
use Illuminate\Auth\Access\HandlesAuthorization;
use Pythagus\LaravelAbstractBasis\Traits\Container;

/**
 * Class AbstractPolicy
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @property bool forced
 *
 * @author: Damien MOLINA
 */
abstract class AbstractPolicy {

    use HandlesAuthorization, Container;

    /**
     * Determine whether the before method
     * should be listened.
     *
     * @var bool
     */
    protected $forced = false ;

    /**
     * Determine whether the before method should
     * be used.
     *
     * @var bool
     */
    protected static $enabled = false ;

    /**
     * @var Closure
     */
    protected static $callback ;

    /**
     * @param null|mixed $user
     * @return bool|null
     */
    public function before($user = null) {
        if(boolval($this->forced) || ! $this->isEnabled() || ! $this->hasCallback()) {
            return null ;
        }

        return boolval(
            call_user_func(static::$callback, $user)
        ) ? true : null ;
    }

    /**
     * Determine whether the forced mode is
     * enabled.
     *
     * @return bool
     */
    private function isEnabled() {
        if(is_null(static::$enabled)) {
            return true ;
        }

        return boolval(static::$enabled) ;
    }

    /**
     * Determine whether a callback was defined.
     *
     * @return bool
     */
    private function hasCallback() {
        return ! is_null(static::$callback) ;
    }

    /**
     * Set the state of the force.
     * Useful in the AppServiceProvider boot method.
     *
     * @param bool $bool
     */
    public static function setEnable(bool $bool = null) {
        static::$enabled = $bool ;
    }

    /**
     * Set the callback.
     * Useful in the AppServiceProvider boot method.
     *
     * @param Closure $callback
     */
    public static function setCallback(Closure $callback) {
        static::$callback = $callback ;
    }

}
