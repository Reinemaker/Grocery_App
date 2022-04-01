<?php
    namespace app\api\http;

	require_once(dirname(__DIR__) . "\\http\\request.php");

	// Create a new instance of the request and initialize it by setting its fields
	// we are using the Factory pattern to some extent
	
	class Requestbuilder{
		
		private $Request;
		
		function getRequest(){
			
			$this->Request = new Request();
			
			$this->Request->method = $_SERVER['REQUEST_METHOD'];
			
			$this->Request->header = apache_request_headers();

			if (count($_GET) == 0) {
				return;
			}
			
			$key = array_keys($_GET)[0];

			if (isset( $_GET[$key] )) {
				
				$this->Request->urlParams = $_GET;
	
			}

            if (($this->Request->method == "POST" || $this->Request->method == "PUT") && $this->Request->header['Content-Type'] == "application/json") {
                $this->Request->payload = json_decode(file_get_contents('php://input'), true);
            } 

			return $this->Request;
			
		}
		
	}
