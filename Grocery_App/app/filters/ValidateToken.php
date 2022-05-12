<?php

namespace app\filters;

use \Firebase\JWT\ExpiredException;

#[\Attribute]
class ValidateToken	{
	function execute(){
        $request_headers = apache_request_headers();
		if (isset($request_headers['Authorization'])) {
			try {
				$jwt = new \app\helpers\JWTHelper();
				$decoded = $jwt->decodeJWT($request_headers['Authorization']);
				$decoded_array = (array) $decoded;
				if ($decoded_array['iss'] == "http://localhost/" && $decoded_array['aud'] == "http://localhost/") {
					if ($decoded_array['exp'] > time()) {
						return false;
					}
				} 
                echo "Jwt token is invalid. Please log-in again.";
                http_response_code(401);
				return true;
			} catch (ExpiredException $e) {
				session_destroy();
                echo "Jwt token is invalid. Please log-in again.";
                http_response_code(401);
				return true;
			}
		}
        echo "Jwt token is invalid. Please log-in again.";
        http_response_code(401);
		return true;
	}

}