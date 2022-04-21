<?php

namespace app\filters;

use \Firebase\JWT\ExpiredException;

#[\Attribute]
class ValidateToken	{
	function execute(){
		if (isset($_SESSION['JWTtoken'])) {
			try {
				$jwt = new \app\helpers\JWTHelper();
				$decoded = $jwt->decodeJWT($_SESSION['JWTtoken']);
				$decoded_array = (array) $decoded;
				if ($decoded_array['iss'] == "http://localhost/" && $decoded_array['aud'] == "http://localhost/") {
					if ($decoded_array['exp'] > time()) {
						return false;
					}
				} 
				header('Location:' . BASE . 'Account/index');
				return true;
			} catch (ExpiredException $e) {
				session_destroy();
				header('Location:' . BASE . 'Account/index');
			}
		}
		header('Location:' . BASE . 'Account/index');
	}

}