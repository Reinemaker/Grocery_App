<?php

namespace app;

class ConfigurationHelper {
    private static $configurations;

    function __construct() {
        if (self::$configurations == null) {
            $config = file_get_contents('C:\xampp\htdocs\Grocery_App\config.json');
            self::$configurations = json_decode($config, true);
        }
    }


    static function getConfigurations() {
        if (self::$configurations == null)
        {
          self::$configurations = new ConfigurationHelper();
        }
     
        return self::$configurations;
    }
}