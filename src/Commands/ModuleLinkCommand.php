<?php

namespace Pythagus\LaravelAbstractBasis\Commands;

use Illuminate\Console\Command;

/**
 * Class ModuleLinkCommand
 * @package Pythagus\LaravelAbstractBasis\Commands
 *
 * @author: Damien MOLINA
 */
class ModuleLinkCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:link' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make the modules symbolic links.' ;

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle() {
		$deleted = 0 ;
		$created = 0 ;

		foreach($this->getModules() as $module => $path) {
			if($this->linkExist($module)) {
				unlink($this->publicPath($module)) ;
				$deleted++ ;
			}

			if(is_dir($this->vendorPath($path))) {
				symlink(
					$this->vendorPath($path), $this->publicPath($module)
				) ;

				$created++ ;
			} else {
				$this->alert("Module $module not found") ;
			}
		}

		$this->makeComment($deleted, 'deleted') ;
		$this->makeComment($created, 'created') ;

		return self::SUCCESS ;
	}

	/**
	 * Get the modules.
	 *
	 * @return array
	 */
	protected function getModules() {
		return config('app.modules', []) ;
	}

	/**
	 * Make a comment to the output.
	 *
	 * @param int $value
	 * @param string $method
	 */
	private function makeComment(int $value, string $method) {
		$this->comment(
			$value . ' file' . ($value > 1 ? 's' : '') . ' ' . $method
		) ;
	}

	/**
	 * Determine whether the given link already
	 * exists.
	 *
	 * @param string $module
	 * @return bool
	 */
	private function linkExist(string $module) {
		return is_link(
			$this->publicPath($module)
		) ;
	}

	/**
	 * Get the public path of the given module.
	 *
	 * @param string $module
	 * @return string
	 */
	private function publicPath(string $module) {
		return public_path($module) ;
	}

	/**
	 * Get the vendor path of the given module.
	 *
	 * @param string $module
	 * @return string
	 */
	private function vendorPath(string $module) {
		return base_path('vendor/'.$module) ;
	}
}
