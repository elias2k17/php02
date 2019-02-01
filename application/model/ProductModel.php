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

	public function createNewProduct() {
		$statement = self::$connection->prepare("INSERT INTO product ...");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}