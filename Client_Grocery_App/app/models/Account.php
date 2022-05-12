<?php

namespace app\models;

class Account extends \app\core\Model
{
    public $account_id;
    public $first_name;
    public $last_name;
    public $username;
    public $password_hash;
    public $address;
    public $is_employee;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $SQL = "INSERT INTO account (first_name, last_name, username, password_hash, address, is_employee) VALUES (:first_name, :last_name, :username, :password_hash, :address, :is_employee)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['first_name' => $this->first_name, 'last_name' => $this->last_name, 'username' => $this->username, 'password_hash' => $this->password_hash, 'address' => $this->address, 'is_employee' => $this->is_employee]);
    }

    public function get($username){
        $SQL = "SELECT * FROM account WHERE username = :username";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['username' => $username]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Account');
        return $STMT->fetch();
    }

    public function getAccountByUsername($username) {
        $SQL = "SELECT * FROM account WHERE username = :username";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['username' => $username]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Account');
        return $STMT->fetch();
    }

    public function update()
	{
		$SQL = "UPDATE account SET first_name=:first_name, last_name=:last_name, address=:address, password_hash = :password_hash WHERE username = :username";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['first_name' => $this->first_name, 'last_name' => $this->last_name, 'address' => $this->address, 'password_hash' => $this->password_hash]);
	}
}
