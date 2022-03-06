<?php

namespace Pythagus\LaravelAbstractBasis\Validators;

use Exception;
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
		$url = config('app.recaptcha.url') ;
		if(empty($url)) {
			throw new Exception("Null ReCaptcha URL") ;
		}

		$secret = config('app.recaptcha.secret') ;
		if(empty($secret)) {
			throw new Exception("Null ReCaptcha secret") ;
		}

		try {
			$response = $this->externalRequest($url, [
				'secret'   => $secret,
				'response' => $value
			]) ;

			return boolval($response->success) ;
		} catch(Throwable $e) {
			return false ;
		}
	}
}
