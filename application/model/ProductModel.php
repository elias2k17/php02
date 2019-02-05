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
		$statement = self::$connection->prepare("INSERT INTO product (name, description, price) VALUE(:name, :description, :price)");
		$statement->bindValue(':name', $data["product_name"], \PDO::PARAM_STR);
		$statement->bindValue(':description', $data["product_description"], \PDO::PARAM_STR);
		$statement->bindValue(':price', $data["product_price"], \PDO::PARAM_STR);
		$statement->execute();
		return $statement->rowCount();
	}
}