<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class AbstractNotification
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractNotification extends Notification implements ShouldQueue {

    use Queueable ;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'] ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [] ;
    }

    /**
     * Make a new instance of MailMessage.
     *
     * @return MailMessage
     */
    public function make() {
        return new MailMessage() ;
    }

}
