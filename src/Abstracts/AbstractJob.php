<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pythagus\LaravelAbstractBasis\Traits\Container;

/**
 * Class AbstractJob
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractJob implements ShouldQueue {

    /**
     * Laravel default traits.
     *
     * @version 7.12
     */
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

    /**
     * Custom traits.
     */
    use Container ;

}