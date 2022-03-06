<?php

namespace Pythagus\LaravelAbstractBasis\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class GenerateRepositoryCommand
 * @package Pythagus\LaravelAbstractBasis\Commands
 *
 * @author: Damien MOLINA
 */
class GenerateRepositoryCommand extends GeneratorCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The name of the class}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new repository file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub () {
        return __DIR__ . '/../stubs/repository.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace.'\Repositories';
    }
}
