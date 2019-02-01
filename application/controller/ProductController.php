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
	}

	public function action_new() {

		if (!$this->request->isPost()) {
			return $this->view->render("error500");
		}

		return $this->view->render("product/new", [
			"title"=>$this->config->get("title"),
			"name"=>$this->request->get("name"), //$_POST["name"]
		]);
	}	

}