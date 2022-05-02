<?php

namespace App\models;

class ShoppingCart extends \App\core\Model{

    public $cart_id;
	public $product_id;
    public $shopping_cart_id;
	public $quantity;

    public function __construct() {
		parent::__construct();
	}

	public function get($list_id) {
		$SQL = 'SELECT * FROM wishlist WHERE list_id = :list_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['list_id'=>$list_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\wishlist');
		return $STMT->fetch();
	}

	public function getAllForClient($client_id) {
		$SQL = 'SELECT * FROM wishlist WHERE client_id=:client_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$client_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\wishlist');
		return $STMT->fetchAll();
	}

	public function insert() {
		$SQL = "INSERT INTO wishlist(client_id,product_id,name,type,quantity) VALUES (:client_id,:product_id,:name,:tupe,:quantity)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$this->client_id,'product_id'=>$this->product_id,'name'=>$this->name,'type'=>$this->type,'quantity'=>$this->quantity]);
	}

	public function delete() {
		$SQL = 'DELETE FROM wishlist WHERE product_id = :product_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$this->product_id]);
	}

}
//WIP