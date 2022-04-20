<?php
namespace App\models;

class Product extends \App\core\Model{
    public $product_id;
    public $dept_id;
    public $name;
    public $picture_path;


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

	public function getAll() {
		$SQL = 'SELECT * FROM product';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute([]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Product');
		return $STMT->fetchAll();
	}

	public function insert() {
		$STMT = self::$_connection->prepare("INSERT INTO product(product_id,name,dept_id,picture_path)
        VALUES (:product_id,:name,:dept_id,:picture_path)");
		$STMT->execute(['product_id'=>$this->product_id,'name'=>$this->name,'dept_id'=>$this->dept_id,'picture_path'=>$this->picture_path]);
	}

	public function update() {
		$SQL = 'UPDATE product SET name=:name, dept_id=:dept_id, picture_path=:picture_path WHERE product_id=:product_id';
        $STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$this->product_id,'name'=>$this->name,'dept_id'=>$this->dept_id,'picture_path'=>$this->picture_path]);
	}

	public function delete() {
		$SQL = 'DELETE FROM product WHERE product_id = :product_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$this->product_id]);
	}
}