<?php

namespace application\controller;

use \application\service\Service;
use \application\service\FrontController;
use \application\model\OrderModel;

class OrderController extends FrontController {

	protected function before() {
		parent::before();
		if (isset($this->session->login)) {
			return true;
		} else {
			return false;
		}
	}

	public function action_update_status() {
		if (!$this->request->isPost() && isset($_POST["order_id"]) && isset($_POST["order_status_id"])) {
			return $this->view->render("error500");
		} else {
			$order = new OrderModel();
			if ($order->setOrderStatus($this->request->getPost("order_id"), $this->request->getPost("order_status_id"))) {
				echo "Order status is changed succsessfully!";
			} else {
				echo "Error happend! Order status isn't changed";
			}
		}
	}

	public function action_index() {
		$order = new OrderModel();
		if ($this->session->role_id == 1) {
			// admin access
			$orderCollection = $order->getOrders();
		} else {
			$orderCollection = $order->getOrdersByUserID($this->session->user_id);
		}

		$this->view->render("order/index", [
			"title"				=> "order Info",
			"orderCollection"	=> $orderCollection,
			"auth_data" => $this->session,
			"order_status_list" => OrderModel::getOrderStatusList()
		]);
		
	}
}