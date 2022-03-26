<?php

use Illuminate\Support\Facades\File;
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

if(! function_exists('last_modified_time')) {
    /**
     * Get the last modified time from
     * the given asset file.
     *
     * @param string $url
     * @return string
     */
    function last_modified_time($url) {
        $version = 0 ;

        try {
            $absolute = $_SERVER['DOCUMENT_ROOT'] . parse_url($url, PHP_URL_PATH) ;
            $version  = File::lastModified($absolute) ;
        } catch(Throwable $ignored) {}

        return $version ;
    }
}