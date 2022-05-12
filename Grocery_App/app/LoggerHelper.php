<?php 
namespace app;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerHelper {

    private static $logger;

    function __construct() {
        if (self::$logger == null) {
            $config = new \app\ConfigurationHelper();
            $config = $config->getConfigurations();
            self::$logger = new Logger('Grocery_App');
            self::$logger->pushHandler(new StreamHandler('C:\xampp\htdocs\Grocery_App\log.txt', Logger::DEBUG));
        }
    }

    static function getLogger() {
        if (self::$logger == null)
        {
          self::$logger = new LoggerHelper();
        }
     
        return self::$logger;
    }
}