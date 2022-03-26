<?php

namespace Pythagus\LaravelAbstractBasis\View\Composers;

use Illuminate\View\View;

/**
 * Class UserComposer
 * @package Pythagus\LaravelAbstractBasis\View\Composers
 *
 * @author: Damien MOLINA
 */
class UserComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $view->with('user', auth()->user()) ;
        $view->with('userFlashErrors', session('flash_notification', collect())) ;
    }
}