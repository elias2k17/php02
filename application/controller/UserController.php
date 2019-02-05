<?php

namespace application\controller;

use \application\service\Service;
use \application\service\FrontController;
use \application\model\UserModel;

class UserController extends FrontController {

	protected function before() {
		parent::before();
		return true;
	}

	public function action_index() {
		$user = new UserModel();
		$userCollection = $user->getUsers();

		if (isset($this->session->login)) {
			return $this->view->render("user/index", [
				"title"				=> "user Info",
				"userCollection"	=> $userCollection,
				"auth_data" => $this->session]);
		} else {
			return $this->view->render("error403");
		}
		
	}

	public function action_login() {
		return $this->view->render("user/login", [
			"title"	=> "user Login Form",
			"name"	=> "Enter your creds"
		]);
	}

	public function action_auth() {
		if (!$this->request->isPost()) {
			return $this->view->render("error500");
		} else {
			$user = new UserModel();
			$user_data = $user->getUserDataByLoginAndPassword($this->request->getPost("login"), $this->request->getPost("password"));
			if ($user_data) {
				$this->session->user_id = $user_data["user_id"];
				$this->session->login = $user_data["login"];
				$this->session->email = $user_data["email"];
				$this->session->role_id = $user_data["role_id"];
				$this->redirect("/?path=home/index");
			} else {
				return $this->view->render("login_failure");
			}
		}
	}

	public function action_logout() {
		$this->session->destroy();
		$this->redirect("/?path=home/index");
		/*
		return $this->view->render("home/index", [
			"title"=>$this->config->get("title"),
			"version"=>$this->config->get("version"),
		]);
		*/
	}	

}