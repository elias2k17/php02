<?php

namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class ProductModel extends BaseModel {

	public function getProducts() {
		$statement = self::$connection->prepare("SELECT * FROM product");
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function getProductById($id) {
		$statement = self::$connection->prepare("SELECT * FROM product WHERE id = :id");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function addNewProduct($data) {
		echo $data["name"];
		$statement = self::$connection->prepare("INSERT INTO product (name, description, price) VALUE(:name, :description, :price)");
		$statement->bindValue(':name', $data["name"], \PDO::PARAM_STR);
		$statement->bindValue(':description', $data["description"], \PDO::PARAM_STR);
		$statement->bindValue(':price', $data["price"], \PDO::PARAM_STR);
		$statement->execute();
		return $statement::lastInsertId ;
	}
}