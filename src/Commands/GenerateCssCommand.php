<?php

namespace Pythagus\LaravelAbstractBasis\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class GenerateCssCommand
 * @package Pythagus\LaravelAbstractBasis\Commands
 *
 * @author: Damien MOLINA
 */
class GenerateCssCommand extends GeneratorCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:css {name : Path to the css file}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new CSS file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'CSS';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub () {
        return __DIR__ . '/stubs/css.stub';
    }

	/**
	 * Get the destination class path.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function getPath($name) {
		return public_path('css/' . $name.'.css') ;
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
