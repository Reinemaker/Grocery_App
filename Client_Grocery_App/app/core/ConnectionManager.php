<?php 

namespace app\core;

class ConnectionManager {
    private $connection;
    private $user;
    private $password;
    private $host;
    private $dbname;

    
    public function __construct() {
        $db_config = simplexml_load_file('C:\xampp\htdocs\Grocery_App\config.xml');

        $this->host = $db_config->host;
        $this->user = $db_config->user;
        $this->password = $db_config->password;
        $this->dbname = $db_config->dbname;
    }

    public function getConnection() {
        $config = new \app\ConfigurationHelper();
        $config = $config->getConfigurations();
        // return new \PDO($config['ConnectionString'], $this->user, $this->password);
        return new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
    }
}