<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Database\Eloquent\Builder;
use Pythagus\LaravelAbstractBasis\Traits\Container;

/**
 * Class AbstractRepository
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractRepository {

    use Container ;

    /**
     * Return an instance of query maker.
     *
     * @example User::query()
     * @return Builder
     */
    abstract public function query() ;

    /**
     * Merge two queries instance.
     *
     * @param array $data
     * @param null $query
     * @return Builder
     */
    protected function whereQuery(array $data, $query = null) {
        if(is_null($query)) {
            $query = $this->query() ;
        }

        return $query->where($data) ;
    }

}
