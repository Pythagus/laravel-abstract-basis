<?php

namespace Pythagus\LaravelAbstractBasis\Database;

use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration as BaseMigration;

/**
 * Class Migration
 * @package Pythagus\LaravelAbstractBasis\Database
 *
 * @property string table
 * @property string class
 *
 * @author: Damien MOLINA
 */
abstract class Migration extends BaseMigration {

	/**
	 * Name of the table
	 *
	 * @var string
	 */
	protected $table ;

	/**
	 * Class name of the migration.
	 *
	 * @var string
	 */
	protected $class ;

	/**
	 * Structure of the table.
	 *
	 * @param Blueprint $table
	 * @return void
	 */
	abstract public function structure(Blueprint $table) ;

	/**
	 * Get the table name from another way, like
	 * from the config folder.
	 *
	 * @return string|null
	 */
	protected function tableName() {
		return null ;
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function down() {
		Schema::dropIfExists($this->getTable()) ;
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function up() {
		$table = $this->getTable() ;

		if(! Schema::hasTable($table)) {
			Schema::create($table, function(Blueprint $t) {
				$this->structure($t) ;
			}) ;
		}
	}

	/**
	 * Get the table name.
	 *
	 * @return string
	 * @throws Exception
	 */
	protected function getTable() {
		if(! empty($this->class)) {
			return app($this->class)->getTable() ;
		}

		if(! empty($this->table)) {
			return $this->table ;
		}

		$name = $this->tableName() ;
		if(! empty($name)) {
			return $name ;
		}

		throw new Exception("Undefined class in " . static::class . " migration.") ;
	}
}
