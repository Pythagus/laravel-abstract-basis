<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Pythagus\LaravelAbstractBasis\Traits\Container;

/**
 * Class AbstractEvent
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractEvent {

    /**
     * Laravel default traits.
     *
     * @version 7.12
     */
    use Dispatchable, InteractsWithSockets, SerializesModels ;

    /**
     * Custom traits.
     */
    use Container ;

}
