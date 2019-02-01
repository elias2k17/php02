<?php

namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class UserModel extends BaseModel {

	private function createUserSession($user_id, $user_login, $user_admin) {
		session_start();
		//Service::set("user_id", $user_id);
		//Service::set("user_login", $user_login);
		//Service::set("user_admin", $user_admin);
		//$_SESSION["user_id"] = Service::get("user_id");
		//$_SESSION["user_login"] = Service::get("user_login");
		//$_SESSION["user_admin"] = Service::get("user_admin");
		$_SESSION["user_id"] = $user_id;
		$_SESSION["user_login"] = $user_login;
		$_SESSION["user_admin"] = $user_admin;
	}

	public function destroyUserSession() {
		//Service::set("user_id", null);
		//Service::set("user_login", null);
		//Service::set("user_admin", null);
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_login"]);
		unset($_SESSION["user_admin"]);
		session_destroy();
	}

	public function authorizeUser($login, $password) {
		$statement = self::$connection->prepare("SELECT * FROM user WHERE login = :login AND pass = :password");
		$statement->bindValue(":login", $login, \PDO::PARAM_STR);
		$statement->bindValue(":password", $password, \PDO::PARAM_STR);
		$statement->execute();
		if ($statement->rowCount() == 1) {
			$row = $statement->fetch(\PDO::FETCH_LAZY);
			$this->createUserSession($row["id"], $row["login"], $row["admin"]);
			return true;
		} else {
			return false;
		}
	}

	public function getUsers() {
		$statement = self::$connection->prepare("SELECT * FROM user");
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function getUserById($id) {
		$statement = self::$connection->prepare("SELECT * FROM user WHERE id = :id");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}	

	public function createNewUser() {
		$statement = self::$connection->prepare("INSERT INTO user ...");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}