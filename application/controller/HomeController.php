<?php

namespace application\controller;

use \application\service\Service;
use \application\service\FrontController;

class HomeController extends FrontController {

	protected function before() {
		parent::before();
		return true;
	}

	public function action_index() {
		session_start();
		print_r($_SESSION);
		print_r(["auth_data"=>$_SESSION["customer_id"]]);
		return $this->view->render("home/index", [
			"title"=>$this->config->get("title"),
			"version"=>$this->config->get("version"),
			"auth_data"=>$_SESSION["customer_id"]
		]);
		
	}


}