<?php

namespace application\controller;

use \application\service\Service;
use \application\service\FrontController;
use \application\model\ProductModel;

class ProductController extends FrontController {

	public function action_index() {
		$product = new ProductModel();
		$productCollection = $product->getProducts();

		$this->view->render("product/index", [
			"title"					=> "Product list",
			"productCollection"	=> $productCollection,
			"auth_data" => $this->session
		]);
		var_dump($this->session);
	}

	public function action_new() {
		#check user rights
		print_r($this->session);
		if ($this->session->role_id !== 1)
		{
			return $this->view->render("error403");
		}

		if (!$this->request->isPost()) {
			return $this->view->render("error500");
		}

		$product = new ProductModel();
		$data = array();
		$data["name"] = $_POST["name"];
		$data["description"] = $_POST["description"];
		$data["price"] = $_POST["price"];
		if ($product->addNewProduct($data)) {
			return $this->view->render("product/index", [
				"title"					=> "Product list",
				"productCollection"	=> $productCollection,
				"auth_data" => $this->session
			]);
		} else {
			//return $this->view->render("error500");
			print_r($data);
		}
	}

	public function action_view() {
		if (!$this->request->isGet()) {
			return $this->view->render("error500");
		}

		$product = new ProductModel();
		#$product_info = $product->getProductById($this->request->getData["product_id"]);
		$productCollection = $product->getProductById($_GET["product_id"]);
		if (!empty($productCollection)) {
			return $this->view->render("product/view", [
				"productCollection" => $productCollection,
				"auth_data" => $this->session
			]);
		} else {
			return $this->view->render("error404");
		}
	}

}