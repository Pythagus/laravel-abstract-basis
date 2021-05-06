<?php

namespace Pythagus\LaravelAbstractBasis\Validators;

use Throwable;
use Pythagus\LaravelAbstractBasis\Traits\ExternalRequest;

/**
 * Class ReCaptcha
 * @package Pythagus\LaravelAbstractBasis\Validators
 *
 * @author: Damien MOLINA
 */
class ReCaptcha {

	use ExternalRequest ;

	/**
	 * @param $attribute
	 * @param $value
	 * @param $parameters
	 * @param $validator
	 * @return bool
     */
	public function validate($attribute, $value, $parameters, $validator) {
		try {
			$response = $this->externalRequest(config('app.recaptcha.url'), [
				'secret'   => config('app.recaptcha.secret'),
				'response' => $value
			]) ;

			return boolval($response->success) ;
		} catch(Throwable $e) {
			return false ;
		}
	}

}
