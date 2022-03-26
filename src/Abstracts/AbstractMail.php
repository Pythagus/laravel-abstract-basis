<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class AbstractMail
 * @package App\Mail
 *
 * @author: Damien MOLINA
 */
abstract class AbstractMail extends Mailable implements ShouldQueue {

    use Queueable, SerializesModels ;

}
