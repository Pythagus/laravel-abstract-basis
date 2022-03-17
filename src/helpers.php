<?php

use Pythagus\LaravelAbstractBasis\Maintenance;

if(! function_exists('maintenance_date')) {
    /**
     * Get the next maintenance date.
     * 
     * @return Carbon|null
     */
    function maintenance_date() {
        return Maintenance::next() ;
    }
}