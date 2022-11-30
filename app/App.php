<?php

/**
 *
 * @property string    $__controller
 * @property string    $__action
 * @property array     $__params
 *
 * @var          array $routes
 */
class App {

	private $__controller, $__action, $__params, $__routes;

	static                                       $app;

	public function __construct() {
		global $routes, $config;
		self::$app = $this;
		if (!empty($routes['default_controller'])) {
			$this->__controller = $routes['default_controller'];
		}
		$this->__routes = new Route();
		$this->__action = 'index';
		$this->__params = [];
	}

	private function getUrl() {
		if (!empty($_SERVER['PATH_INFO'])) {
			$url = $_SERVER['PATH_INFO'];
		} else {
			$url = '/';
		}
		return $url;
	}

	function handleUrl() {
		$url    = $this->getUrl();
		$url    = $this->__routes->handleRoute($url);
		$urlArr = array_filter(explode('/', $url));
		$urlArr = array_values($urlArr);
		//		echo '<pre>';
		//		print_r($urlArr);
		//		die;
		$urlCheck = '';
		foreach ($urlArr as $key => $item) {
			$urlCheck                     .= $item . '/';
			$fileCheck                    = rtrim($urlCheck, '/');
			$fileArr                      = explode('/', $fileCheck);
			$fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
			$fileCheck                    = implode('/', $fileArr);
			if (!empty($urlArr[$key - 1])) {
				unset($urlArr[$key - 1]);
			}
			if (file_exists('app/controllers/' . $fileCheck . '.php')) {
				$urlCheck = $fileCheck;
				break;
			}
		}
		$urlArr = array_values($urlArr);
		//		echo '<pre>';
		//		print_r(array_values($urlArr));
		//		die;
		// Handle controller
		if (!empty($urlArr[0])) {
			$this->__controller = ucfirst($urlArr[0]);
			unset($urlArr[0]);
		} else {
			$this->__controller = ucfirst($this->__controller);
		}
		if (empty($urlCheck)) {
			$urlCheck = $this->__controller;
		}
		if (file_exists('app/controllers/' . $urlCheck . '.php')) {
			require_once 'controllers/' . $urlCheck . '.php';
			if (class_exists($this->__controller)) {

				$this->__controller = new $this->__controller();
			} else {
				$this->loadError('Not found controller ' . $this->__controller);
			}
		} else {
			$this->loadError('Not found : ' . 'controllers/' . $this->__controller . '.php');
		}
		//Handle action
		if (!empty($urlArr[1])) {
			$this->__action = $urlArr[1];
			unset($urlArr[1]);
		}
		//Handle params
		$this->__params = array_values($urlArr);
		if (method_exists($this->__controller, $this->__action)) {

			call_user_func_array([
				$this->__controller,
				$this->__action,
			], $this->__params);
		} else {
			$this->loadError('Action: ' . $this->__action . ' not found');
		}
	}

	/**
	 * @param     $data
	 * @param int $name
	 */
	function loadError( $name = 404, $data) {
		extract($data);
		require_once 'error/' . $name . '.php';
	}
}
