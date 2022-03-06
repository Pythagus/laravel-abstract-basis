<?php

namespace Pythagus\LaravelAbstractBasis\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder as BaseSeeder;

/**
 * Class Seeder
 * @package Pythagus\LaravelAbstractBasis\Database
 *
 * @author: Damien MOLINA
 */
abstract class Seeder extends BaseSeeder {

    /**
     * The primary key of the model. This value
     * determines which column will be responsible
     * of the unicity of the value.
     *
     * @var string
     */
    public $primaryKey = 'id' ;

    /**
     * If an item already exists in the
     * datatable, this property allows
     * you to update or not the found
     * object.
     *
     * @var bool
     */
    protected $update = false ;

    /**
     * This method should return the whole data
     * that will be inserted in the database.
     *
     * @return array
     */
    abstract public function all() ;

    /**
     * This method should return a new query
     * instance from the model.
     *
     * @example User::query()
     *
     * @return Builder
     */
    abstract protected function query() ;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run() {
        foreach($this->all() as $item) {
            $query = $this->similarQuery($item) ;

            if($query->exists()) {
                if($this->update) {
                    $this->update($query->first(), $item) ;
                }
            } else {
                $this->insert($item) ;
            }
        }
    }

    /**
     * Insert the item in the datatable.
     *
     * @param array|string $item
     * @throws Exception
     */
    public function insert($item) {
        $model = $this->query()->getModel() ;

        $this->update(new $model, $item) ;
    }

    /**
     * Update the item instance.
     *
     * @param Model $model
     * @param array|string $data
     */
    public function update(Model $model, $data) {
        /*
         * If the given data is an array,
         * then we just call the fill method.
         */
        if(is_array($data)) {
            $model->fill($data) ;
        }
        /*
         * If It is a string, then we update
         * the primary key value of the model.
         */
        elseif(is_string($data)) {
            $model->{$this->primaryKey} = $data ;
        }

        /*
         * In all case, we save the
         * model from the modifications.
         */
        $model->save() ;
    }

    /**
     * Get a formatted query to find
     * the similar models.
     *
     * @param array|string $item
     * @return Builder
     */
    protected function similarQuery($item) {
        $key   = $this->primaryKey ;
        $value = is_array($item) ? $item[$key] : $item ;

        return $this->query()->where($key, $value) ;
    }
}