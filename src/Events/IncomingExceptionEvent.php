<?php

namespace Pythagus\LaravelAbstractBasis\Events;

use Throwable;
use Pythagus\LaravelAbstractBasis\Abstracts\AbstractEvent;

/**
 * Class IncomingExceptionEvent
 * @package Pythagus\LaravelAbstractBasis\Events
 *
 * @property Throwable throwable
 * @property null      request
 *
 * @author: Damien MOLINA
 */
class IncomingExceptionEvent extends AbstractEvent {

    /**
     * @var Throwable
     */
    private $throwable ;

    /**
     * @var null
     */
    private $request ;

    /**
     * Create a new event instance.
     *
     * @param Throwable $throwable
     * @param null $request
     */
    public function __construct(Throwable $throwable, $request = null) {
        $this->throwable = $throwable ;
        $this->request   = $request ;
    }

    /**
     * Get the incoming exception.
     *
     * @return Throwable
     */
    public function getException() {
        return $this->throwable ;
    }

    /**
     * Get the request.
     *
     * @return null
     */
    public function getRequest() {
        return $this->request ;
    }

}
