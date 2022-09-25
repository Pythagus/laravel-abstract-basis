<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class AbstractMail
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractMail extends Mailable {

    use Queueable, SerializesModels ;

}