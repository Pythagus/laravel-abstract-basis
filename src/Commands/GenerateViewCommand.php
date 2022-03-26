<?php

namespace Pythagus\LaravelAbstractBasis\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class GenerateViewCommand
 * @package Pythagus\LaravelAbstractBasis\Commands
 *
 * @author: Damien MOLINA
 */
class GenerateViewCommand extends GeneratorCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {name : Path to the view}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new blade file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub () {
        return __DIR__ . '/../stubs/view.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name) {
        return $this->laravel->resourcePath() . '/views/' . $name.'.blade.php' ;
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name) {
        return $name ;
    }
}
