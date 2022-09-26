<?php

namespace Pythagus\LaravelAbstractBasis\View\Assets;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * Asset manager in the Blade files.
 * 
 * @author Damien MOLINA
 */
class Facade extends LaravelFacade {

    /**
     * Build a new asset manager.
     *
     * @param string $section
     * @return AssetManager
     */
    public static function manager(string $section) {
        return new AssetManager($section) ;
    }

    /**
     * Render a new JS script.
     *
     * @param string $path
     * @param boolean $module
     * @return AssetManager
     */
    public static function js(string $path, bool $module = false) {
        return static::manager('scripts')->js($path, $module) ;
    }

    /**
     * Render a CSS file.
     *
     * @param string $path
     * @return AssetManager
     */
    public static function css(string $path) {
        return static::manager('styles')->css($path) ;
    }
}