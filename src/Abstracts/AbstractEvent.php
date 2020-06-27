<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class AbstractEvent
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractEvent {

    use Dispatchable, InteractsWithSockets, SerializesModels;

}
