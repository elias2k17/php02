<?php

namespace application\service;

use \application\service\Service;

class FrontController {

	protected 
		$session,
		$view,
		$config,
		$request;
	
	public function __construct() {
		$this->session = Service::get("session");
		$this->view = Service::view();
		$this->config = Service::config();
		$this->request = Service::request();
	}

	protected function before() {
		return true;
	}

	protected function redirect($url)
	{
		return header('Location: ' . $url);
	}

	/**
	 * /?path=controller/action
	 * Ex: /?path=home/index
	 */
	public function run() {
		
		if (is_null($this->request->get("path"))) {
			throw new \Exception("Wrong path");
		}

		list($controller, $action) = explode("/", $this->request->get("path"));

		//HomeController
		$class = '\\application\\controller\\'.ucfirst($controller)."Controller";
		//echo $class . "<br>";

		if (!class_exists($class)) {
			return $this->view->render("error500");
		}

		$controller = new $class;

		if (!method_exists($controller, "action_".$action)) {
			return $this->view->render("error500");
		}

		if (!$controller->before()) {
			return $this->view->render("error403");
		}

		return $controller->{"action_".$action}();
	}
}