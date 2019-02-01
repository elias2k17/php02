<?php

namespace application\model;

use \application\service\Service;
use \application\model\BaseModel;

class OrderModel extends BaseModel {

	public static function getOrderStatusList() {
		$statement = self::$connection->prepare("SELECT * FROM order_status");
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function setOrderStatus($order_id, $order_status_id) {
		try {
		$statement = self::$connection->prepare("UPDATE user_order SET order_status_id = :order_status_id WHERE order_id = :order_id");
		$statement->bindValue(':order_status_id', $order_status_id, \PDO::PARAM_INT);
		$statement->bindValue(':order_id', $order_id, \PDO::PARAM_INT);
		$statement->execute();
		return true;
		} catch (\PDOException $e) {
			print_r($e);
		}
	}

	public function getOrders() {
		$statement = self::$connection->prepare("SELECT * FROM user_order o JOIN user u ON u.`user_id` = o.`user_id` JOIN order_status s ON s.`order_status_id` = o.`order_status_id` ORDER BY order_date DESC");
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getOrdersByUserID($user_id) {
		$statement = self::$connection->prepare("SELECT * FROM user_order o JOIN user u ON u.`user_id` = o.`user_id` JOIN order_status s ON s.`order_status_id` = o.`order_status_id` WHERE u.`user_id` = :user_id ORDER BY order_date DESC");
		$statement->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function getOrderById($id) {
		$statement = self::$connection->prepare("SELECT * FROM user_order WHERE id = :id");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}
}