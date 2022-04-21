<?php
namespace App\models;

class Product extends \App\core\Model{
    public $product_id;
    public $dept_id;
    public $name;
    public $picture_path;
	public $price;


	public function __construct() {
		parent::__construct();
	}

	public function get($product_id) {
		$SQL = 'SELECT * FROM product WHERE product_id = :product_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Product');
		return $STMT->fetch();
	}

	public function search($search_word){
		$SQL = 'SELECT * FROM product WHERE name LIKE :search_word';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['search_word'=>'%'.$search_word.'%']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Product');
		return $STMT->fetchAll();
	}

	public function getAll() {
		$SQL = 'SELECT * FROM product';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute([]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Product');
		return $STMT->fetchAll();
	}

	public function insert() {
		$STMT = self::$_connection->prepare("INSERT INTO product(product_id,name,type,quantity)
        VALUES (:product_id,:name,:type,:quantity)");
		$STMT->execute(['product_id'=>$this->product_id,'name'=>$this->name,'type'=>$this->type,'quantity'=>$this->quantity]);
	}

	public function update() {
		$SQL = 'UPDATE product SET name=:name, type=:type, quantity=:quantity WHERE product_id=:product_id';
        $STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$this->product_id,'name'=>$this->name,'type'=>$this->type,'quantity'=>$this->quantity]);
	}

	public function delete() {
		$SQL = 'DELETE FROM product WHERE product_id = :product_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$this->product_id]);
	}
}