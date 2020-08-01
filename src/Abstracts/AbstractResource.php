<?php

namespace Pythagus\LaravelAbstractBasis\Abstracts;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AbstractResource
 * @package Pythagus\LaravelAbstractBasis\Abstracts
 *
 * @author: Damien MOLINA
 */
abstract class AbstractResource extends JsonResource {

	/**
	 * Only kept the given keys in the attributes.
	 *
	 * @param array $keys
	 * @return array
	 */
	protected function only(array $keys) {
	    return array_intersect_key(
            $this->resource->toArray(), array_flip((array) $keys)
        ) ;
	}

    /**
     * Get the resource as an array.
     *
     * @param $resource
     * @param null $request
     * @return array
     */
    public static function array($resource, $request = null) {
        return static::collection($resource)->toArray($request) ;
    }

}
