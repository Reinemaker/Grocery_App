<?php

error_reporting(E_ALL ^ E_WARNING); 

include('app/init.php');
require  'vendor/autoload.php';
new \app\api\Api();
