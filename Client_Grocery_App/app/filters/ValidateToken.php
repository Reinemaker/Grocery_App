<?php

namespace app\filters;

#[\Attribute]
class ValidateToken	{
	function execute(){
		if (isset($_SESSION['JWTtoken'])) {
			$jwt = new \app\helpers\JWTHelper();
			$decoded = $jwt->decodeJWT($_SESSION['JWTtoken']);
			$decoded_array = (array) $decoded;
			if ($decoded_array['iss'] == "http://localhost/" && $decoded_array['aud'] == "http://localhost/") {
				if ($decoded_array['exp'] > time()) {
					return true;
				}
			} 
			return false;
		}
	}

}