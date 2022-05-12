<?php

namespace app\controllers;

use OpenApi\Generator;
/**
 * @OA\Get(
 *     path="/api/ApiDefinitionGenerator",
 *     @OA\Response(response="200", description="Generates an OpenAPI definition file in a yaml format")
 * )
 */

class ApiDefinitionGenerator {
    function get() {
        $openapi = Generator::scan(['C:\xampp\htdocs\Grocery_App\Grocery_App\app']);
        header('Content-Type: application/x-yaml');
        echo $openapi->toYaml();
    }
}