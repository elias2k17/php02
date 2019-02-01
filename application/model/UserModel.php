<?php

namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class UserModel extends BaseModel {
	public function getUserDataByLoginAndPassword($login, $password) {
		$statement = self::$connection->prepare("SELECT * FROM user WHERE login = :login AND pass = :password");
		$statement->bindValue(":login", $login, \PDO::PARAM_STR);
		$statement->bindValue(":password", $password, \PDO::PARAM_STR);
		$statement->execute();
		if ($statement->rowCount() == 1) {
			$row = $statement->fetch(\PDO::FETCH_LAZY);
			return $row;
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