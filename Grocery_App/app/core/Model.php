<?php 
namespace app\core;

class Model {
    protected static $_connection = null;
    
    public function __construct() {
        if (self::$_connection == null) {
            $connection = new \app\core\ConnectionManager();
            self::$_connection = $connection->getConnection();
        }
    }
}
?>