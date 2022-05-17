<?php

namespace app\models;

class TransactionHistory extends \app\core\Model
{
    public $transaction_id;
    public $product_id;
    public $quantity;
    
    public function insert(){
        $SQL = "INSERT INTO transaction_history(transaction_id,product_id, quantity) VALUES (:transaction_id,:product_id, :quantity)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['transaction_id' => $this->transaction_id, 'product_id'=>$this->product_id, 'quantity'=>$this->quantity]);
    }

    public function get($transaction_id) {
        $SQL = "SELECT * FROM transaction_history WHERE transaction_id = :transaction_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['transaction_id' => $transaction_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\TransactionHistory');
        return $STMT->fetchAll();
    }
}
