<?php

namespace Pythagus\LaravelAbstractBasis\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class GenerateJsCommand
 * @package Pythagus\LaravelAbstractBasis\Commands
 *
 * @author: Damien MOLINA
 */
class GenerateJsCommand extends GeneratorCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:js {name : Path to the css file}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new JS file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'JS';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub () {
        return __DIR__ . '/stubs/js.stub';
    }

	/**
	 * Get the destination class path.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function getPath($name) {
		return public_path('js/' . $name.'.js') ;
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
