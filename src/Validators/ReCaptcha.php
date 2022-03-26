<?php

namespace Pythagus\LaravelAbstractBasis\Validators;

use Exception;
use Throwable;
use anlutro\cURL\cURL;

/**
 * Class ReCaptcha
 * @package Pythagus\LaravelAbstractBasis\Validators
 *
 * @author: Damien MOLINA
 */
class ReCaptcha {

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
			$response = (new cURL())->post($url, [
				'secret'   => $secret,
				'response' => $value
			]) ;
			$body = json_decode($response->getBody(), true) ;

			return boolval($body['success'] ?? false) ;
		} catch(Throwable $ignored) {
			return false ;
		}
	}
}
