<?php

namespace Pythagus\LaravelAbstractBasis\View\Assets;

use Illuminate\Support\Facades\Facade;

/**
 * Asset manager in the Blade files.
 * 
 * @author Damien MOLINA
 */
class AssetManager extends Facade {

    /**
     * The section the content will be put in.
     *
     * @var string
     */
    protected $section ;

    /**
     * The asset content that will be put.
     *
     * @var string
     */
    protected $content ;

    /**
     * A View factory instance.
     *
     * @var \Illuminate\View\Factory
     */
    protected $factory ;

    /**
     * Build a new asset manager instance.
     *
     * @param string $section
     */
    public function __construct(string $section) {
        $this->section = $section ;
        $this->factory = app('view') ;
    }

    /**
     * Prepend the content.
     *
     * @return void
     */
    public function prepend(): void {
        $this->factory->startPrepend($this->section, $this->content) ;
    }

    /**
     * Push the content.
     *
     * @return void
     */
    public function push(): void {
        $this->factory->startPush($this->section, $this->content) ;
    }

    /**
     * Set the content as a JS script.
     *
     * @param string $path
     * @param boolean $module
     * @return static
     */
    public function js(string $path, bool $module = false): static {
        $this->content = '<script type="' 
            . ($module ? 'module' : "text/javascript")
            . '" src="'
            . asset($path)
            . "?version="
            . last_modified_time($path)
            . '"></script>' ;

        return $this ;
    }

    /**
     * Set the content as a style sheet.
     *
     * @param string $path
     * @return static
     */
    public function css(string $path): static {
        $this->content = '<link rel="stylesheet" href="'
            . asset($path) 
            . "?version="
            . last_modified_time($path)
            . '">' ;

        return $this ;
    }

    /**
     * If we are here, then neither prepend()
     * or push() methods were called. Then we 
     * do the default action: push.
     *
     * @return string
     */
    public function __toString(): string {
        $this->push() ;

        return "" ;
    }
}