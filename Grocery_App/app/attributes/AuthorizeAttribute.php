<?php

namespace app\attributes;

use Exception;

class AuthorizeAttribute	{
	function execute(){
		$headers = apache_request_headers();
        if(!isset($headers['Authorization'])){
			throw new Exception("Authorization header not found");
		}
        $jwt = new \app\api\JWTHelper();
        $jwtArray = (array) $jwt->decodeJWT($headers['Authorization']);
        if ($jwtArray['exp'] < time()) {
			throw new Exception("Token expired");
		}
		return true;
	}
}
