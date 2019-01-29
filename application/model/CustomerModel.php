<?php

namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class CustomerModel extends BaseModel {

	private function createCustomerSession($customer_id, $customer_login, $customer_admin) {
		session_start();
		//Service::set("customer_id", $customer_id);
		//Service::set("customer_login", $customer_login);
		//Service::set("customer_admin", $customer_admin);
		//$_SESSION["customer_id"] = Service::get("customer_id");
		//$_SESSION["customer_login"] = Service::get("customer_login");
		//$_SESSION["customer_admin"] = Service::get("customer_admin");
		$_SESSION["customer_id"] = $customer_id;
		$_SESSION["customer_login"] = $customer_login;
		$_SESSION["customer_admin"] = $customer_admin;
	}

	public function destroyCustomerSession() {
		//Service::set("customer_id", null);
		//Service::set("customer_login", null);
		//Service::set("customer_admin", null);
		unset($_SESSION["customer_id"]);
		unset($_SESSION["customer_login"]);
		unset($_SESSION["customer_admin"]);
		session_destroy();
	}

	public function authorizeCustomer($login, $password) {
		$statement = self::$connection->prepare("SELECT * FROM customers WHERE login = :login AND pass = :password");
		$statement->bindValue(":login", $login, \PDO::PARAM_STR);
		$statement->bindValue(":password", $password, \PDO::PARAM_STR);
		$statement->execute();
		if ($statement->rowCount() == 1) {
			$row = $statement->fetch(\PDO::FETCH_LAZY);
			$this->createCustomerSession($row["id"], $row["login"], $row["admin"]);
			return true;
		} else {
			return false;
		}
	}

	public function getCustomers() {
		$statement = self::$connection->prepare("SELECT * FROM customers");
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function getCustomerById($id) {
		$statement = self::$connection->prepare("SELECT * FROM customers WHERE id = :id");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}	

	public function createNewCustomer() {
		$statement = self::$connection->prepare("INSERT INTO customers ...");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}