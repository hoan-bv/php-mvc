<?php

class Route {

	function __construct() {

	}

	function handleRoute($url) {
		global $routes;
		unset($routes['default_controller']);
		$url = trim($url, '/');
		if (empty($url)) {
			$url = '/';
		}
		$handleUrl = $url;
		if (!empty($routes)) {
			foreach ($routes as $key => $route) {
				if (preg_match('~' . $key . '~is', $url)) {
					$handleUrl = preg_replace('~' . $key . '~is', $route, $url);
					//					echo '<pre>';
					//					print_r($handleUrl);
					//					die;
				}
			}
		}
		return $handleUrl;
		//		echo '<pre>';
		//		print_r($url);
		//		die;
	}
}
