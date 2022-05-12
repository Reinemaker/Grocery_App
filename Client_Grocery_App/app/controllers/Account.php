<?php

namespace app\controllers;

class Account extends \app\core\Controller
{
	public function index()
	{
		$this->view('Main/index');
	}

	#[\app\filters\ValidateToken]
	public function home()
	{
		$product = new \app\models\Product();
		$products = $product->getAll();

		$this->view('Main/home', ['products' => $products]);
	}

	public function register()
	{
		echo "register";
		if (
			isset($_POST['action']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username'])
			&& isset($_POST['address']) && $_POST['password'] == $_POST['password_confirm']
		) {
			$account = new \app\models\Account();
			if ($account->getAccountByUsername($_POST['username']) == false) {
				$account->first_name = $_POST['first_name'];
				$account->last_name = $_POST['last_name'];
				$account->username = $_POST['username'];
				$account->address = $_POST['address'];
				$account->password = $_POST['password'];
				$account->is_employee = false;
				$account->insert();
				header('Location:' . BASE . 'login');
			} else {
				$this->view('Main/index', ['error' => 'Username already exists!']);
			}
		} else
			$this->view('Main/index');
	}

	public function login()
	{
		echo "login";
		if (isset($_POST['action'])) {
			$account = new \app\models\Account();
			$account = $account->getAccountByUsername($_POST['username']);
			if ($account != false && password_verify($_POST['password'], $account->password_hash)) {
				$_SESSION['account_id'] = $account->account_id;
				//generate token
				$jwt = new \app\helpers\JWTHelper();
				$_SESSION['JWTtoken'] = $jwt->generateJWT($account);
				$_SESSION['JWTDecoded'] = $jwt->decodeJWT($_SESSION['JWTtoken']);
				header('location:' . BASE . 'Account/home');
			} else {
				$this->view('Main/index', ['error' => 'Wrong username or password!']);
			}
		} else
			$this->view('Main/index');
	}

	#[\app\filters\ValidateToken]
	function updateAccount()//doesn't serialize password
	{
		echo "update";
		$account = new \App\models\Account();
		//$account = $account->get($username);
		//$account->username = $username;

		//This is a temporary
		$this->view('Main/update');
		
		if (isset($_POST["action"])) {
			if ($_POST['password'] == $_POST['password_confirm']) {
				$account->first_name = $_POST['first_name'];
				$account->last_name = $_POST['last_name'];
				$account->address = $_POST['address'];
				$account->password_hash = $_POST['password'];
				$account->update();
				header('location:' . BASE . 'Main/home');
			} else {
				$this->view('Main/update', ['error' => 'Password does not match!']);
			}
		}
		$this->view('Main/home');
	}

	public function logout()
	{
		session_destroy();
		header('location:' . BASE . 'Main/index');
	}
}
