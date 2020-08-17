<?php

namespace Pythagus\LaravelAbstractBasis;

use Illuminate\Support\ServiceProvider;
use Pythagus\LaravelAbstractBasis\Commands\GenerateRepositoryCommand;

/**
 * Class QuickMigrationServiceProvider
 * @package Pythagus\LaravelQuickMigration
 *
 * @property array commands
 *
 * @author: Damien MOLINA
 */
class AbstractBasisServiceProvider extends ServiceProvider {

    /**
     * @var array
     */
    protected $commands = [
        GenerateRepositoryCommand::class,
    ] ;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->commands($this->commands) ;
    }

}