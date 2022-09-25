<?php

namespace Pythagus\LaravelAbstractBasis;

use Illuminate\Support\Facades\View;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Pythagus\LaravelAbstractBasis\Commands\ModuleLinkCommand;
use Pythagus\LaravelAbstractBasis\View\Composers\UserComposer;

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
        ModuleLinkCommand::class,
    ] ;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        // Boot the view composers.
        View::composer('*', UserComposer::class) ;

        // Registering the asset alias.
        AliasLoader::getInstance()->alias('Asset', 'Pythagus\LaravelAbstractBasis\View\Assets\Facade') ;

        // Boot the validators.
        Validator::extend(
            'recaptcha', 'Pythagus\\LaravelAbstractBasis\\Validators\\ReCaptcha@validate'
        ) ;

        // Publish the views.
        $this->loadViewsFrom(__DIR__ . '/views', 'abstract-basis') ;
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/abstract-basis')
        ]) ;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->commands($this->commands) ;

        $this->publishes(
            $this->getStubs(['migration.create', 'seeder']), 'abstract-basis-stubs'
        ) ;
    }

    /**
     * Get the stubs path.
     * 
     * @param array $names
     * @return array
     */
    private function getStubs(array $names) {
        $files = [] ;

        foreach($names as $name) {
            $files[__DIR__.'/stubs/'.$name.'.stub'] = base_path('stubs/'.$name.'.stub') ;
        }

        return $files ;
    }
}
