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
		# user should have admin rights (role_id = 1)
		if ($this->session->role_id != 1)
		{
			return $this->view->render("error403");
		}

		if (!$this->request->isPost()) {
			return $this->view->render("error500");
		}

		$product = new ProductModel();
		$data = array();
		$data["product_name"] = $this->request->getPost("product_name");
		$data["product_description"] = $this->request->getPost("product_description");
		$data["product_price"] = $this->request->getPost("product_price");

		if ($product->addNewProduct($data)) {
			return $this->redirect("/?path=product/index");
		} else {
			return $this->view->render("error500");
		}
	}

	public function action_view() {
		if (!$this->request->isGet()) {
			return $this->view->render("error500");
		}

		$product = new ProductModel();
		$productCollection = $product->getProductById($this->request->getData("product_id"));
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