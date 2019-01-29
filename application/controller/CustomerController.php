<?php

namespace application\controller;

use \application\service\Service;
use \application\service\FrontController;
use \application\model\CustomerModel;

class CustomerController extends FrontController {

	protected function before() {
		parent::before();
		return true;
	}

	public function action_index() {
		$customer = new CustomerModel();
		$customerCollection = $customer->getCustomers();

		$this->view->render("customer/index", [
			"title"					=> "Customer Info",
			"customerCollection"	=> $customerCollection
		]);
		
	}

	public function action_login() {
		return $this->view->render("customer/login", [
			"title"	=> "Customer Login Form",
			"name"	=> "Enter your creds"
		]);
	}

	public function action_auth() {
		if (!$this->request->isPost()) {
			return $this->view->render("error500");
		} else {
			$customer = new CustomerModel();
			#if ($customer->authorizeCustomer($customer->request->getPost["login"], $customer->request->getPost["password"])) {
			if ($customer->authorizeCustomer($_POST["login"], $_POST["password"])) {
				header('Location: /?path=home/index');
			} else {
				return $this->view->render("login_failure");
			}
		}
	}

	public function action_logout() {
		$customer = new CustomerModel();
		$customer->destroyCustomerSession();
		return $this->view->render("home/index", [
			"title"=>$this->config->get("title"),
			"version"=>$this->config->get("version"),
		]);
	}	

}